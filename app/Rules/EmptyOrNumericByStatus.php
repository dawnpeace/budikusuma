<?php

namespace App\Rules;

use App\enums\DocumentStatus;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class EmptyOrNumericByStatus implements Rule
{

    private $request;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
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
        if ($this->request->has('status')) {
            if( in_array($this->request->get('status'), DocumentStatus::STATUS_NOT_DONE) ){
                return empty($value) || is_numeric($value);
            } else {
                return is_numeric($value);
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be number';
    }
}
