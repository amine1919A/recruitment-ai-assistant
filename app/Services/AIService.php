<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIService
{
    private function callAI(array $messages, int $maxTokens = 4000): string
    {
        $apiKey = env('GEMINI_API_KEY');

        if (empty($apiKey)) {
            return "AI Error: GEMINI_API_KEY est manquante dans le fichier .env";
        }

        $prompt = "";
        foreach ($messages as $msg) {
            $role = ($msg['role'] === 'system') ? "Instruction système" : "Utilisateur";
            $prompt .= $role . " :\n" . trim($msg['content']) . "\n\n";
        }

        // ✅ MODÈLES DISPONIBLES (choisir un):
        // Option 1 (RECOMMANDÉ) : Flash 2.0 - Rapide et performant
        //$model = 'gemini-1.5-flash';
        
        // Option 2 : Flash 1.5 - Stable et fiable
        // $model = 'gemini-1.5-flash';
        
        // Option 3 : Pro 1.5 - Plus puissant mais plus lent
         $model = "gemini-2.5-flash"; 

        $response = Http::timeout(120)
            ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key=" . $apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.4,
                    'maxOutputTokens' => $maxTokens,
                    'topP' => 0.95,
                    'topK' => 20
                ]
            ]);

        if (!$response->successful()) {
            Log::error('Gemini API Error', [
                'status' => $response->status(),
                'body'   => $response->body(),
                'model'  => $model
            ]);

            return "AI Error: " . $response->status() . " - " . $response->body();
        }

        $result = $response->json('candidates.0.content.parts.0.text');

        return $result ?? "Pas de réponse valide de l'IA.";
    }

    public function analyzeCV($text)
    {
        $text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');
        $text = substr($text, 0, 12000);

        return $this->callAI([
            [
                'role' => 'system',
                'content' => 
"Tu es un Senior HR Manager expert en analyse de CV.

RÈGLES ABSOLUES :
- Réponse COMPLÈTE obligatoire
- Toujours terminer TOUTES les sections
- Format structuré strict
- Français professionnel
- Scoring précis et justifié"
            ],
            [
                'role' => 'user',
                'content' =>
"Analyse ce CV de manière COMPLÈTE et DÉTAILLÉE.

⚠️ IMPORTANT : Tu DOIS compléter TOUTES les sections sans exception.

FORMAT OBLIGATOIRE :

📊 PROFIL PROFESSIONNEL
👤 Résumé : [description en 2-3 lignes]
⭐ Score Global : [X]/100
📈 Niveau : [Junior/Confirmé/Senior/Expert]

💪 POINTS FORTS (minimum 4)
- [Point fort 1 avec justification]
- [Point fort 2 avec justification]
- [Point fort 3 avec justification]
- [Point fort 4 avec justification]

⚠️ POINTS FAIBLES (minimum 3)
- [Point faible 1 avec explication]
- [Point faible 2 avec explication]
- [Point faible 3 avec explication]

🎯 COMPÉTENCES CLÉS
- Techniques : [liste]
- Soft Skills : [liste]
- Langues : [liste]

💼 RECOMMANDATIONS RH (minimum 3)
1. [Recommandation immédiate]
2. [Recommandation à court terme]
3. [Recommandation à long terme]

🎓 FORMATIONS SUGGÉRÉES
- [Formation 1]
- [Formation 2]

CV À ANALYSER :
" . $text
            ]
        ], 3000);
    }

    public function generateQuestion($cvText)
    {
        if (strlen(trim($cvText)) < 50) {
            return "Erreur: CV trop court ou vide";
        }

        return $this->callAI([
            [
                'role' => 'system',
                'content' => 
    'Tu es un recruteur expert senior chez une grande entreprise tech.

    RÈGLES ABSOLUES pour générer la question :
    - Tu dois générer UNE SEULE question complète et détaillée
    - La question doit faire MINIMUM 15 mots
    - Elle doit être basée sur une compétence PRÉCISE du CV
    - Format professionnel et engageant
    - JAMAIS de salutations ou remerciements
    - SEULEMENT la question, rien d\'autre'
            ],
            [
                'role' => 'user',
                'content' => 
    "Analyse ce CV et génère UNE question d'entretien professionnelle, détaillée et précise.

    EXEMPLES DE BONNES QUESTIONS :
    - \"Pouvez-vous me décrire un projet complexe où vous avez utilisé React et Node.js ensemble ? Quels défis techniques avez-vous rencontrés et comment les avez-vous résolus ?\"
    - \"Dans votre expérience avec Python et l'analyse de données, comment avez-vous géré un dataset de plusieurs millions de lignes ? Quels outils et méthodologies avez-vous utilisés ?\"
    - \"Parlez-moi d'une situation où vous avez dû résoudre un conflit au sein de votre équipe. Quelle approche avez-vous adoptée et quel a été le résultat ?\"

    IMPORTANT : 
    - Question COMPLÈTE de 20-40 mots minimum
    - SANS introduction (pas de \"Bonjour\", \"Merci\", etc.)
    - Basée sur les compétences RÉELLES du CV ci-dessous

    CV DU CANDIDAT :
    " . substr($cvText, 0, 6000)
            ]
        ], 600); // Plus de tokens pour une question complète
    }
    public function evaluateAnswer($question, $answer)
    {
        return $this->callAI([
            [
                'role' => 'system',
                'content' => 'Tu es un recruteur expert qui évalue les réponses avec précision et bienveillance.'
            ],
            [
                'role' => 'user',
                'content' => 
"Question posée : {$question}

Réponse du candidat : {$answer}

Évalue cette réponse selon ce format :

📊 SCORE : [X]/10

✅ POINTS POSITIFS :
- [point 1]
- [point 2]

⚠️ POINTS À AMÉLIORER :
- [point 1]
- [point 2]

💡 FEEDBACK :
[conseil constructif en 2-3 lignes]"
            ]
        ], 800);
    }

    public function matchJob($cvText, $jobDesc)
    {
        return $this->callAI([
            [
                'role' => 'system',
                'content' => 'Tu es un expert en matching CV/Offre d\'emploi avec 15 ans d\'expérience.'
            ],
            [
                'role' => 'user',
                'content' => 
"Compare ce CV avec la description du poste de manière DÉTAILLÉE.

FORMAT OBLIGATOIRE :

📊 SCORE DE COMPATIBILITÉ : [X]/100

✅ COMPÉTENCES CONCORDANTES (minimum 5)
- [Compétence 1] - [Niveau de match]
- [Compétence 2] - [Niveau de match]
- [Compétence 3] - [Niveau de match]
- [Compétence 4] - [Niveau de match]
- [Compétence 5] - [Niveau de match]

❌ COMPÉTENCES MANQUANTES (minimum 3)
- [Compétence 1] - [Importance : Critique/Moyenne/Faible]
- [Compétence 2] - [Importance]
- [Compétence 3] - [Importance]

⚡ POINTS FORTS DU CANDIDAT
- [Point 1]
- [Point 2]
- [Point 3]

💼 RECOMMANDATIONS
1. [Action immédiate]
2. [Formation suggérée]
3. [Conseil pour l'entretien]

🎯 VERDICT : [Recommandé/À considérer/Non recommandé]

CV :
{$cvText}

DESCRIPTION DU POSTE :
{$jobDesc}"
            ]
        ], 3500);
    }

    public function generateOptimizedCV($cvText, $jobDesc)
    {
        return $this->callAI([
            [
                'role' => 'system',
                'content' => 'Tu es un expert en rédaction de CV avec une expertise en ATS (Applicant Tracking Systems).'
            ],
            [
                'role' => 'user',
                'content' => 
"Crée un CV OPTIMISÉ pour cette offre d'emploi basé sur le CV actuel.

RÈGLES :
- Garde les informations véridiques du CV original
- Réorganise et reformule pour matcher l'offre
- Utilise les mots-clés de l'offre
- Structure ATS-friendly
- Format professionnel

FORMAT DE SORTIE :

=== INFORMATIONS PERSONNELLES ===
[Nom, Contact, Titre professionnel]

=== PROFIL PROFESSIONNEL ===
[Résumé percutant aligné avec l'offre - 3-4 lignes]

=== COMPÉTENCES CLÉS ===
[Liste organisée par catégories, avec mots-clés de l'offre]

=== EXPÉRIENCE PROFESSIONNELLE ===
[Poste] - [Entreprise] - [Dates]
- [Réalisation 1 avec résultats chiffrés]
- [Réalisation 2 alignée avec l'offre]
- [Réalisation 3]

=== FORMATION ===
[Diplômes pertinents]

=== CERTIFICATIONS ===
[Si applicable]

CV ACTUEL :
{$cvText}

OFFRE D'EMPLOI :
{$jobDesc}"
            ]
        ], 4000);
    }
}