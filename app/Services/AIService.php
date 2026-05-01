<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AIService
{
    public function generateQuestion($cvText)
{
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
    ])->post('https://api.openai.com/v1/chat/completions', [
        'model' => 'gpt-4o-mini',
        'messages' => [
            [
                'role' => 'system',
                'content' => 'Tu es un recruteur RH.'
            ],
            [
                'role' => 'user',
                'content' => "Génère une question d'entretien basée sur ce CV:\n".$cvText
            ]
        ]
    ]);

    return $response['choices'][0]['message']['content'];
}
    public function evaluateAnswer($question, $answer)
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
        Question: $question

        Réponse candidat: $answer

        Donne:
        - Score /100
        - Feedback
        - Amélioration
        "
                    ]
                ]
            ]);

            return $response['choices'][0]['message']['content'];
        }
    public function matchJob($cvText, $jobDesc)
        {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "
        Compare ce CV avec cette offre d'emploi :

        CV:
        $cvText

        JOB:
        $jobDesc

        Donne:
        - Score /100
        - Compatibilité
        - Recommandations
        "
                    ]
                ]
            ]);

            return $response['choices'][0]['message']['content'];
        }
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
