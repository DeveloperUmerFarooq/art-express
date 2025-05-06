<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class EmailValidator
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('ABSTRACT_API_KEY');
    }

    public function validate($email)
    {
        $url = 'https://emailvalidation.abstractapi.com/v1/?api_key=' . $this->apiKey . '&email=' . $email;

        $response = Http::get($url);

        if ($response->successful()) {
            $data = $response->json();
            return [
                'is_valid_format' => $data['is_valid_format']['value'] ?? false,
                'is_smtp_valid'   => $data['is_smtp_valid']['value'] ?? false,
                'is_deliverable'  => $data['deliverability']==="DELIVERABLE",
                'autocorrect'     => $data['autocorrect'] ?? null,
            ];
        }

        return null;
    }
}
