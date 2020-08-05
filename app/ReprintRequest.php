<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReprintRequest extends Model
{

    protected $fillable = ["id_number"];

    public function reprintable()
    {
        return $this->morphTo();
    }

}
