<?php

namespace App\Exceptions;

use Exception;

class NotLoggedUser extends Exception
{

    public function __construct(){
        parent::__construct( 'Please log in so that you can use the features of the site');
    }
}
