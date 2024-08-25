<?php

namespace App\Exceptions;

use Exception;

class RatingFailedException extends Exception
{
    public function NotUserLoggoin(){
        return "please log in the website to can create rating";
    }
}
