<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIService
{
    public function analyzeCV(string $text)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Tu es un recruteur expert.'
                ],
                [
                    'role' => 'user',
                    'content' => "
Analyse ce CV et donne :

- Score /100  
- Points forts  
- Points faibles  
- Recommandation métier  

CV:
".$text
                ]
            ],
            'temperature' => 0.3
        ]);

        return $response['choices'][0]['message']['content'];
    }
}