@servers(['web' => ['benoit-cabocel@13.39.150.46']])


@story("deploy")
    pull-from-github
    update-dependencies
    migrate-db
    optimize-app
@endstory

@task("pull-from-github", ['on' => 'web'])
    cd /home/benoit-cabocel/benoit-cabocel.dhonnabhain.me/app

    git fetch --all
    git checkout production
    git reset --hard origin/production
@endtask

@task('update-dependencies', ['on' => 'web'])
    cd /home/benoit-cabocel/benoit-cabocel.dhonnabhain.me/app

    composer install
    npm install
    npm run build
@endtask


@task('migrate-db', ['on' => 'web'])
    cd /home/benoit-cabocel/benoit-cabocel.dhonnabhain.me/app

   php artisan migrate --force
@endtask


@task('optimize-app', ['on' => 'web'])
    cd /home/benoit-cabocel/benoit-cabocel.dhonnabhain.me/app

    composer install --optimize-autoloader --no-dev
    php artisan optimize:clear
    php artisan optimize
@endtask
