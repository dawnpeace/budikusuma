<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueueRequest extends Model
{
    protected $table = 'queue_requests';

    protected $dates = ['appointed_at', 'created_at', 'updated_at'];

    protected $fillable = [
        'appointed_at', 'note', 'user_id', 'document'
    ];

    public function user() {
        return $this->belongsTo(User::class, "user_id");
    }
    
}
