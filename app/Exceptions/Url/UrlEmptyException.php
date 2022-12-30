<?php

namespace App\Exceptions\Url;

class UrlEmptyException extends \DomainException
{
    public function __construct()
    {
        parent::__construct(
            'Url can\'t be empty',
            406
        );
    }
}
