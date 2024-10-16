<?php

namespace App\Rules;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\ValidationRule;

class ProfileImageValidator implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $client = new Client();

        $response = $client->post('http://127.0.0.1:5000/detect_humans', [
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => fopen($value->getPathname(), 'r'),
                    'filename' => $value->getClientOriginalName()
                    ]
                    ]
                ]);

        $responseBody = json_decode($response->getBody(), true);

        if($responseBody['human_detected']==false){
            // abort(500);
            $fail('This not human image or image with low quality');
        };
    }
}
