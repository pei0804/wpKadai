<?php

namespace Slimvc\Facade;

class DatabaseFacade extends \SlimFacades\Facade{
    protected static function getFacadeAccessor() { return 'db'; }
}