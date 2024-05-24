<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('application', 'backoffice');
set('repository', 'https://github.com/FranGre/backoffice.git');

add('shared_files', ['.env', 'database/database.sqlite']);
add('shared_dirs', ['bootstrap/cache', 'storage']);
add('writable_dirs', ['bootstrap/cache', 'storage']);

// Hosts

host('54.208.47.115')
    ->set('remote_user', 'backoffice-deployer')
    ->set('identity_file', '~/.ssh/id_rsa')
    ->set('deploy_path', '/home/backoffice-deployer/var/www');

set('keep_releases', 3);

// Taks

task('build', function () {
    run('cd {{release_path}} && build');
});

task('reload:php-fpm', function(){
    run('sudo /etc/init.d/php8.3-fpm restart');
});

// Hooks

after('deploy:failed', 'deploy:unlock');
// before('deploy:symlink', 'artisan:migrate');
after('deploy', 'reload:php-fpm');
