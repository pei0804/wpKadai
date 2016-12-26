<?php

namespace Slimvc\Facade;

class SentryFacade extends \SlimFacades\Facade{
    protected static function getFacadeAccessor() { return 'sentry'; }
}