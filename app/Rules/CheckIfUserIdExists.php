<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class CheckIfUserIdExists implements Rule
{

    public $attributeMessage;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $userId)
    {
        $checkIfUserIdExists = $this->checkIfUserIdExists($userId);

        if (!$checkIfUserIdExists) {
            $this->attributeMessage = "User Id does not exist";
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->attributeMessage;
    }

    public function checkIfUserIdExists($userId) {
        $user = User::where('id', $userId)->first();

        if (is_null($user)) {
            return false;
        }

        if (!is_null($user)) {
            return true;
        }
    }
}
