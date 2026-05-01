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
                    'content' => 'Tu es un expert RH senior qui analyse des CV.'
                ],
                [
                    'role' => 'user',
                    'content' => "
Analyse ce CV et retourne STRICTEMENT :

1. Score sur 100  
2. Points forts  
3. Points faibles  
4. Recommandation métier  

CV:
".$text
                ]
            ],
            'temperature' => 0.4
        ]);

        return $response['choices'][0]['message']['content'];
    }
}
