#!/usr/bin/env bash
echo "##### post-receive hook #####"
read oldrev newrev refname
echo "Push triggered update to revision $newrev ($refname)"

RUN_FOR_REF="refs/heads/main"
if [[ "$refname" ==  "$RUN_FOR_REF" ]]; then
    GIT="env -i git"
    CMD_CD="cd $(readlink -nf "$PWD/..")"
    CMD_FETCH="$GIT fetch"
    CMD_COMPOSER="if [ -d vendor/ ]; then sudo chmod -R ug+rw vendor/; fi; composer install --optimize-autoloader --no-dev 2>&1"
    CMD_MIGRATE="php artisan migrate --force"
    CMD_NPM="npm ci"
    CMD_LARAVEL_OPTIMIZE="php artisan optimize"

    echo "$ $CMD_CD"
    eval ${CMD_CD}
    echo "$ $CMD_FETCH"
    eval ${CMD_FETCH}
    echo "$ $CMD_COMPOSER"
    eval ${CMD_COMPOSER}

    echo "$ $CMD_LARAVEL_OPTIMIZE"
    eval ${CMD_LARAVEL_OPTIMIZE}

    echo "$ $CMD_MIGRATE"
    eval ${CMD_MIGRATE}

    if $GIT diff --name-only $oldrev $newrev | grep "^package-lock.json"; then
        echo "$ $CMD_NPM"
        eval $CMD_NPM
    else
        echo "# Skipping npm install, lockfile not modified"
    fi

    if $GIT diff --name-only $oldrev $newrev | grep "^resource/"; then
        echo "$ $CMD_BUILD"
        eval $CMD_BUILD
    else
        echo "# Skipping asset rebuild, no changes in resource folder"
    fi
else
    echo "Ref does not match $RUN_FOR_REF, exiting."
fi

echo "##### end post-receive hook #####"
