<?php

namespace App\Rules;

use Closure;
use App\Models\User;
use App\Models\Regex;
use Illuminate\Contracts\Validation\ValidationRule;

class regexValidator implements ValidationRule
{


    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
       $regex = Regex::select('regex')->where('country','=',$_REQUEST['country'])->first();
       $userExists = User::where($attribute,'=',$value)->exists();

       if($regex !=null){
        if(!preg_match($regex->regex,$value)){
            $fail('worng Passport number');
           }elseif($userExists){
            $fail('Passport number already exists');
           }
       }else{
           $fail('This country not available now');
       }

    }
}
