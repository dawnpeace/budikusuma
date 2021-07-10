<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ReprintRequest extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'reprint_requests';

    protected $fillable = ["id_number", "user_id", "type", "status"];

    public function reprintable()
    {
        return $this->morphTo();
    }

    public function isPrinted()
    {
        return !is_null($this->printed_at);
    }


}
