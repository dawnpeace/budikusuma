<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReprintRequest extends Model
{
    protected $table = 'reprint_requests';

    protected $fillable = ["id_number", "user_id"];

    public function reprintable()
    {
        return $this->morphTo();
    }

    public function isPrinted()
    {
        return !is_null($this->printed_at);
    }

}
