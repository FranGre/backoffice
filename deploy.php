<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'https://github.com/FranGre/backoffice.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('54.208.47.115')
    ->set('remote_user', 'deployer')
    ->set('deploy_path', '~/backoffice');

// Hooks

after('deploy:failed', 'deploy:unlock');
