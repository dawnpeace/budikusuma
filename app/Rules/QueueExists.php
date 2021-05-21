<?php

namespace App\Rules;

use App\QueueRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class QueueExists implements Rule
{
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $queueCount = QueueRequest::where('document', $value)
            ->where('user_id', Auth::id())
            ->whereDate('appointed_at', '>=', Carbon::now())
            ->count();
        
        return $queueCount == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You have a current running queue.';
    }
}
