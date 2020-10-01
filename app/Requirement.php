<?php

namespace App;

use App\enums\Document;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $table = "requirements";
    protected $fillable = ["document", "description"];


    public static function getDocument($documentType) 
    {
        return self::query()->where("document", $documentType)->value('description');
    }

    /**
     * @return Collection
     */
    public static function loadRequirements()
    {
        return self::query()
            ->whereIn('document', Document::ALL)
            ->get()
            ->keyBy('document');
    }
    
}
