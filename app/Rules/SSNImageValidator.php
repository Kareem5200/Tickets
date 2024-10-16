<?php

namespace App\Rules;

use Closure;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\ValidationRule;

class SSNImageValidator implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $client = new Client();
        $response2 = $client->post('http://127.0.0.1:6000/ocr', [
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => fopen($value->getPathname(), 'r'),
                    'filename' => $value->getClientOriginalName()
                    ]
                    ]
                ]);

        $responseBody2 = json_decode($response2->getBody(), true);
// dd($responseBody2);
        $user_exists = User::where('ssn','=',$responseBody2['national_id'])->exists();
        if($responseBody2['national_id']==false){
             $fail('This not SSN image or image with low quality');
            // return redirect()->back()->with('error','This not ssn image or image with low quality');
        }elseif($user_exists){
            $fail('This SSN already exists');
        }
    }
}
