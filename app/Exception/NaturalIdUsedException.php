<?php

namespace App\Exceptions;

use Exception;

class NaturalIdUsedExceptions extends Exception {

    protected $naturalId;

    public function __construct($naturalId)
    {
        $this->naturalId = $naturalId;
        $this->message = "Natural Id of: " . $naturalId . " has been used";
    }

    public function getNaturalId()
    {
        return $this->naturalId;
    }

}