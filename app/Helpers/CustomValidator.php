<?php

namespace App\Helpers;

use Illuminate\Validation\Validator;

class CustomValidator extends Validator
{

    /**
     * Require a certain number of parameters to be present.
     *
     * @param  int $count
     * @param  array $parameters
     * @param  string $rule
     * @return void
     * @throws \InvalidArgumentException
     */

    public function requireParameterCount($count, $parameters, $rule)
    {
        if (count($parameters) < $count) :
            throw new InvalidArgumentException("Validation rule $rule requires at least $count parameters.");
        endif;
    }

    /**
     * Replace variable to messages
     *
     * @param $message
     * @param $attribute
     * @param $rule
     * @param $parameters
     * @return mixed
     */
    protected function replaceMaxMb($message, $attribute, $rule, $parameters)
    {
        return str_replace(':max_mb', $parameters[0], $message);
    }


    /**
     * Validation
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateMaxMb($attribute, $value, $parameters)
    {
        $megabytes = $value->getSize() / 1024 / 1024;
        return $megabytes < $parameters[0];
    }

    /**
     * Validation
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateEndDate($attribute, $value, $parameters)
    {
        return strtotime($value) >= strtotime($this->getValue($parameters[0]));
    }
}
