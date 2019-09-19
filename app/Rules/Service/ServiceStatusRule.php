<?php

namespace App\Rules\Service;

use App\Enums\ServiceStatus;
use Illuminate\Contracts\Validation\Rule;

class ServiceStatusRule implements Rule
{
    /**
     * Create a new rule instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, ServiceStatus::getValues());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid service status!';
    }
}
