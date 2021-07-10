<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class OptionalSize implements Rule
{
    private $size;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $size)
    {
        $this->size = $size;
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
        if(strlen($value) == 0) {
            return true;
        } else {
            return strlen($value) == $this->size;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be '.$this->size.' character(s).';
    }
}
