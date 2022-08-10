<?php

namespace DevNullIr\LaravelFreeHost\core\Facade;
use Illuminate\Support\Facades\Facade;

/**
 * class LaravelFreeHost
 *
 *
 * @method static object|array|bool|int sendPhoto(array $data = [])
 */
class LaravelFreeHost extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return "LaravelFreeHost";
    }
}
