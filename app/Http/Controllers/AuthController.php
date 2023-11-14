<?php

namespace App\Http\Controllers;

use App\Enums\SocialProvider;
use App\Http\Requests\OauthProviderRequest;
use App\Models\DiscordUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthController extends Controller
{
    private static function createRedirectUrl(string $provider): string
    {
        return config('app.url') . "/oauth/callback/$provider";
    }

    public function redirect(OauthProviderRequest $request)
    {
        $validated = $request->validated();
        $driver = Socialite::driver($validated['provider'])->stateless();
        switch ($validated['provider']) {
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

    public function callback(OauthProviderRequest $request)
    {
        $validated = $request->validated();
        $driver = Socialite::driver($validated['provider'])->stateless();
        $data = $driver->user();
        if ($validated['provider'] === SocialProvider::Discord->value) {
            $discord_user = DiscordUser::updateOrCreate([
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

            /**
             * @type $user User
             */
            $user = $discord_user->user()->first();
            if (!$user) {
                $user = Auth::user();
                if (!$user) {
                    $user = User::create([
                        'name' => $discord_user->public_name
                    ]);
                }
                $discord_user->update(['user_id' => $user->id]);
            }

            Auth::login($user);
        }
        return redirect(RouteServiceProvider::HOME);
    }


    public function login(): RedirectResponse
    {
        return redirect('/oauth/redirect/discord');
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
