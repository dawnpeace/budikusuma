<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $table = "requirements";
    protected $fillable = ["document", "description"];


    public static function getDocument($documentType) {
        return self::query()->where("document", $documentType)->value('description');
    }
    
}
