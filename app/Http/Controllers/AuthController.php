<?php

namespace App\Http\Controllers;

use App\Enums\SocialProvider;
use App\Http\Requests\BotLoginRequest;
use App\Http\Requests\OauthProviderRequest;
use App\Models\DiscordUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthController extends Controller {
  protected const LOGIN_LOCALE_SESSION_KEY = 'login_locale';

  private static function createRedirectUrl(string $provider):string {
    return config('app.url')."/oauth/callback/$provider";
  }

  public function redirect(OauthProviderRequest $request) {
    $validated = $request->validated();
    $driver = Socialite::driver($validated['provider'])->stateless();
    switch ($validated['provider']){
      case SocialProvider::Discord->value:
        // Overwrite scopes from socialite provider package, we do not need nor want user e-mails
        $driver->setScopes(['identify']);
      break;
      default:
        throw new NotFoundHttpException();
    }
    $driver->redirectUrl(self::createRedirectUrl($validated['provider']));

    return $driver->redirect();
  }

  public function callbackGuest(OauthProviderRequest $request) {
    $validated = $request->validated();
    $driver = Socialite::driver($validated['provider'])->stateless();
    $data = $driver->user();
    if ($validated['provider'] !== SocialProvider::Discord->value){
      abort(500, "Validated provider {$validated['provider']} does not match expectations");
    }

    $discord_user = $this->updateOrCreateDiscordUser($data);

    /**
     * @type $user User
     */
    $user = $discord_user->user()->first();
    if (!$user){
      $user = Auth::user();
      if (!$user){
        $user = User::create([
          'name' => $discord_user->public_name,
        ]);
      }
      $discord_user->update(['user_id' => $user->id]);
    }

    Auth::login($user);

    $login_locale = session()?->pull(self::LOGIN_LOCALE_SESSION_KEY);

    return redirect(RouteServiceProvider::HOME.($login_locale ?? ''));
  }

  public function callbackAuthenticated(OauthProviderRequest $request) {
    /**
     * @type $user User|null
     */
    $user = Auth::user();
    if (!$user){
      abort(403, "User is not logged in");
    }

    $validated = $request->validated();
    $driver = Socialite::driver($validated['provider'])->stateless();
    $data = $driver->user();
    if ($validated['provider'] !== SocialProvider::Discord->value){
      abort(500, "Validated provider {$validated['provider']} does not match expectations");
    }

    $discord_user = $this->updateOrCreateDiscordUser($data);
    $discord_user->update(['user_id' => $user->id]);

    $login_locale = session()?->pull(self::LOGIN_LOCALE_SESSION_KEY) ?? App::getLocale();

    return redirect()->route('profile.edit', ['locale' => $login_locale]);
  }

  protected function updateOrCreateDiscordUser($data) {
    /**
     * @var DiscordUser $result
     */
    $result = DiscordUser::updateOrCreate([
      'id' => $data->getId(),
    ], [
      'id' => $data->getId(),
      'name' => $data->user['username'],
      'display_name' => $data->user['global_name'] ?? null,
      'discriminator' => $data->user['discriminator'],
      'avatar' => $data->user['avatar'],
      'access_token' => $data->token,
      'refresh_token' => $data->refreshToken,
      'scopes' => $data->accessTokenResponseBody['scope'],
      'token_expires' => (new Carbon())->add('seconds', $data->expiresIn),
    ]);

    return $result;
  }

  public function login(Request $request):RedirectResponse {
    $locale = $request->route('locale') ?? App::getLocale();
    $possible_locales = [
      ...config('languages.supported_locales'),
      ...array_keys(config('languages.locale_route_alias')),
    ];
    if (in_array($locale, $possible_locales, true)){
      session()?->put(self::LOGIN_LOCALE_SESSION_KEY, $locale);
    }

    return redirect("/$locale/oauth/redirect/discord");
  }

  /**
   * Destroy an authenticated session.
   */
  public function logout(Request $request):RedirectResponse {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }

  public function botLogin(BotLoginRequest $request) {
    if (!$request->hasValidSignature()){
      abort(401);
    }

    $discordUserId = $request->route('discordUserId');
    $locale = $request->route('locale');
    $data = $request->validated();

    $user = null;
    DB::transaction(function () use ($discordUserId, $data, &$user) {
      $discordUser = DiscordUser::updateOrCreate(['id' => $discordUserId], $data);

      /** @var User $user */
      $user = $discordUser->user()->first();
      if (!$user){
        $user = $discordUser->user()->create([
          'name' => $discordUser->public_name,
        ]);
        $discordUser->update(['user_id' => $user->id]);
      }
    });

    if (!$user){
      return response(500);
    }

    Auth::login($user);

    $locale_route_alias = config('languages.locale_route_alias');
    if (array_key_exists($locale, $locale_route_alias)){
      $locale = $locale_route_alias[$locale];
    }

    return redirect()->route('settings', ['locale' => $locale]);
  }
}
