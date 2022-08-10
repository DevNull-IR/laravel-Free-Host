<?php

namespace DevNullIr\LaravelFreeHost\core\Exceptions;

use \Exception;
class FreeHostException extends Exception
{
    public function errorMessage()
    {
        $errorMsg = 'Error on line ' . $this->getLine() . ': <b>' . $this->getMessage() . '</b>';
        return $errorMsg;
    }
}
