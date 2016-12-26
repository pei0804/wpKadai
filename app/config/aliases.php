<?php

$config['aliases'] = array(
    'Slim'      => 'Slim\Slim',
    'Middleware'=> 'Slim\Middleware',
    'Model'     => 'Illuminate\Database\Eloquent\Model',
    'App'       => 'SlimFacades\App',
    'Config'    => 'SlimFacades\Config',
    'Input'     => 'SlimFacades\Input',
    'Log'       => 'SlimFacades\Log',
    'Request'   => 'SlimFacades\Request',
    'View'      => 'SlimFacades\View',
    'Response'  => 'Slimvc\Facade\ResponseFacade',
    'Sentry'    => 'Slimvc\Facade\SentryFacade',
    'Route'     => 'Slimvc\Facade\RouteFacade',
    'DB'        => 'Slimvc\Facade\DatabaseFacade',
    'Module'    => 'Slimvc\Facade\ModuleManagerFacade',
    'Menu'      => 'Slimvc\Facade\MenuManagerFacade',
    'Validator' => 'Slimvc\Facade\ValidatorFacade',
    'CSRF'      => 'Slimvc\Facade\CsrfProtectionFacade'
);