<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Subscription;
// use StaffStrength\ExitMgtProcessor\Traits\ExitReasonTraits;



class CheckIfCurrentPlanExists implements Rule
{
    // use ExitReasonTraits;

    public $attributeMessage;


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $planId)
    {
        // $schoolId = getSchoolId();

        $checkIfCurrentPlanExists = $this->checkIfCurrentPlanExists($planId);

        if($checkIfCurrentPlanExists){
            $this->attributeMessage =  "Selected plan is currrently active";
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

    /**
     * Check if email exist
     */
    private function checkIfCurrentPlanExists($planId)
    {
        $record = Subscription::where('plan_id', $planId)->where('is_active', true)->first();
        if(is_null($record)){
            return false;
        }
        if(!is_null($record)){
            return true;
        }
    }
}
