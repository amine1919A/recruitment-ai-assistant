<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIService
{
    private function callAI(array $messages, int $maxTokens = 4000): string
    {
        $apiKey = env('OPENCODE_API_KEY');

        if (empty($apiKey)) {
            return "AI Error: OPENCODE_API_KEY est manquante dans le fichier .env";
        }

        $openaiMessages = [];
        foreach ($messages as $msg) {
            $role = ($msg['role'] === 'system') ? 'system' : 'user';
            $openaiMessages[] = [
                'role' => $role,
                'content' => $msg['content']
            ];
        }

        $model = env('OPENCODE_MODEL', 'deepseek-v4-flash-free');

        $response = Http::timeout(120)
            ->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])
            ->post("https://opencode.ai/zen/v1/chat/completions", [
                'model' => $model,
                'messages' => $openaiMessages,
                'temperature' => 0.3,
                'max_tokens' => $maxTokens,
                'top_p' => 0.95,
            ]);

        if (!$response->successful()) {
            Log::error('OpenCode AI API Error', [
                'status' => $response->status(),
                'body'   => $response->body(),
                'model'  => $model
            ]);

            return "AI Error: " . $response->status() . " - " . $response->body();
        }

        $result = $response->json('choices.0.message.content');
        if (empty($result)) {
            $result = $response->json('choices.0.message.reasoning_content');
        }

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
"Tu es un Senior HR Manager avec 15+ ans d'expérience dans le recrutement tech et non-tech.
Tu analyses les CV avec une grille d'évaluation multicritères rigoureuse et objective.

RÈGLES ABSOLUES :
- Réponse COMPLÈTE obligatoire — ne JAMAIS laisser de section vide
- Format structuré strict avec les emojis fournis
- Notation précise et justifiée pour chaque axe
- Style professionnel, français impeccable
- Aucune donnée personnelle sensible dans le rapport"
            ],
            [
                'role' => 'user',
                'content' =>
"Analyse ce CV de manière COMPLÈTE, PROFESSIONNELLE et DÉTAILLÉE.

⚠️ CHAQUE section DOIT être complétée. Réponse incomplète = réponse invalide.

FORMAT OBLIGATOIRE À RESPECTER STRICTEMENT :

📊 PROFIL PROFESSIONNEL
👤 Résumé : [synthèse percutante en 3-4 lignes du profil]
⭐ Score Global : [X]/100
📈 Niveau : [Stagiaire/Débutant/Junior/Confirmé/Senior/Expert]
💼 Expérience : [X années]

📊 GRILLE D'ÉVALUATION MULTICRITÈRES (Total: 100)
🎯 Compétences Techniques (sur 30) : [X]/30
   Forces : [2-3 points clés]
   Lacunes : [1-2 points manquants]
🤝 Soft Skills & Leadership (sur 20) : [X]/20
   Forces : [2-3 points clés]
   Axes d'amélioration : [1-2 points]
💼 Expérience & Réalisations (sur 25) : [X]/25
   Points forts : [2-3 réalisations marquantes]
   Manque de : [1-2 éléments manquants]
🎓 Formations & Certifications (sur 10) : [X]/10
   Pertinence : [évaluation]
   Suggestions : [1-2 formations recommandées]
🌍 Langues & Mobilité (sur 15) : [X]/15
   Niveaux : [détail par langue]
   Mobilité : [disponibilité géographique]

💪 POINTS FORTS (minimum 5)
- [Point fort détaillé avec justification précise basée sur le CV]
- [Point fort détaillé avec justification précise]
- [Point fort détaillé avec justification précise]
- [Point fort détaillé avec justification précise]
- [Point fort détaillé avec justification précise]

⚠️ POINTS FAIBLES / LACUNES (minimum 4)
- [Point faible avec recommandation pour l'améliorer]
- [Point faible avec recommandation]
- [Point faible avec recommandation]
- [Point faible avec recommandation]

🔍 ANALYSE DES LACUNES (GAP ANALYSIS)
- Compétences recherchées absentes : [liste]
- Expériences manquantes : [liste]
- Formations recommandées : [liste]

🎯 COMPÉTENCES CLÉS DÉTECTÉES
- Techniques : [liste priorisée par maîtrise]
- Soft Skills : [liste priorisée]
- Langues : [langue : niveau (CECRL)]
- Outils & Technologies : [liste des outils maîtrisés]

📈 SCORE ATS (Compatibilité avec les systèmes de suivi) : [X]/100
   Mots-clés détectés : [liste des mots-clés métier trouvés]
   Mots-clés manquants : [liste des mots-clés importants absents]
   Optimisation recommandée : [conseil pour améliorer le score ATS]

💼 RECOMMANDATIONS RH ACTIONNABLES
🔴 Priorité Haute (immédiat) :
1. [Action concrète avec justification]
2. [Action concrète avec justification]
🟡 Priorité Moyenne (court terme - 3 mois) :
1. [Action avec échéance]
2. [Action avec échéance]
🟢 Priorité Faible (long terme - 6+ mois) :
1. [Action avec échéance]

🎓 FORMATIONS & CERTIFICATIONS SUGGÉRÉES
- [Formation] : [plateforme] - [durée] - [pertinence pour le profil]
- [Formation] : [plateforme] - [durée] - [pertinence]
- [Formation] : [plateforme] - [durée] - [pertinence]

🏢 TYPES DE POSTES RECOMMANDÉS
- [Poste 1] : [type d'entreprise, secteur]
- [Poste 2] : [type d'entreprise, secteur]
- [Poste 3] : [type d'entreprise, secteur]

CV À ANALYSER :
" . $text
            ]
        ], 4000);
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
"Tu es un recruteur expert senior qui prépare des entretiens structurés.
Tu adaptes le niveau de difficulté des questions au profil détecté dans le CV.

RÈGLES ABSOLUES :
- UNE SEULE question à la fois, complète (20-40 mots minimum)
- Question basée sur une compétence PRÉCISE et RÉELLE du CV
- Pas de salutations, pas d'introduction, pas de remerciements
- La question doit évaluer à la fois la compétence technique et le raisonnement
- Niveau de difficulté adapté au profil (Junior/Confirmé/Senior)"
            ],
            [
                'role' => 'user',
                'content' =>
"Analyse ce CV et génère UNE question d'entretien professionnelle.

Directives :
- Identifie la compétence la plus distinctive du candidat
- Formule une question qui teste à la fois la connaissance technique ET la capacité de raisonnement
- Si le candidat est Junior → question sur un projet ou une compétence de base avec mise en situation
- Si le candidat est Confirmé → question sur un défi technique complexe avec métriques
- Si le candidat est Senior → question stratégique impliquant architecture, équipe ou arbitrages techniques
- Structure : mise en situation + action attendue + résultat mesurable

EXEMPLES :
- Junior : \"Dans votre expérience avec React, pouvez-vous me décrire comment vous avez structuré les composants d'une application et géré l'état global ? Qu'avez-vous appris de cette expérience ?\"
- Confirmé : \"Vous avez implémenté une architecture microservices avec Node.js. Quels ont été les défis de communication inter-services que vous avez rencontrés et comment avez-vous géré la cohérence des données ?\"
- Senior : \"En tant que lead technique, comment avez-vous arbitré entre temps de développement, dette technique et qualité logicielle sur votre dernier projet ? Donnez un exemple concret de compromis assumé.\"

IMPORTANT :
- UNE QUESTION UNIQUEMENT
- Sans introduction ni conclusion
- Minimum 25 mots
- Adaptée au niveau réel du candidat

CV DU CANDIDAT :
" . substr($cvText, 0, 6000)
            ]
        ], 600);
    }

    public function evaluateAnswer($question, $answer)
    {
        return $this->callAI([
            [
                'role' => 'system',
                'content' =>
"Tu es un recruteur expert qui évalue les réponses avec une grille objective et constructive.
Tu notes chaque critère séparément pour donner un feedback précis."
            ],
            [
                'role' => 'user',
                'content' =>
"Évalue cette réponse d'entretien selon une grille multicritères.

Question posée : {$question}

Réponse du candidat : {$answer}

FORMAT D'ÉVALUATION OBLIGATOIRE :

📊 SCORE GLOBAL : [X]/10

📋 GRILLE DÉTAILLÉE :
🎯 Pertinence de la réponse (sur 3) : [X]/3
   - [Justification]
🧠 Qualité du raisonnement (sur 3) : [X]/3
   - [Justification]
💬 Clarté et structure (sur 2) : [X]/2
   - [Justification]
🔬 Connaissances démontrées (sur 2) : [X]/2
   - [Justification]

✅ POINTS POSITIFS (minimum 2)
- [Point positif spécifique]
- [Point positif spécifique]

⚠️ AXES D'AMÉLIORATION (minimum 2)
- [Point précis à améliorer]
- [Point précis à améliorer]

💡 FEEDBACK CONSTRUCTIF :
[Paragraphe de 3-4 lignes avec conseil actionable pour progresser]

🏆 VERDICT RECRUTEUR :
- Embauche immédiate / À considérer / À revoir / Refus
- [Justification en 1 phrase]"
            ]
        ], 800);
    }

    public function matchJob($cvText, $jobDesc)
    {
        return $this->callAI([
            [
                'role' => 'system',
                'content' =>
"Tu es un expert en matching CV/Offre d'emploi avec 15 ans d'expérience en tant que Talent Acquisition Specialist.
Tu utilises une méthodologie de matching pondéré par catégories de compétences."
            ],
            [
                'role' => 'user',
                'content' =>
"Compare ce CV avec la description du poste de manière DÉTAILLÉE ET CHIFFRÉE.

FORMAT OBLIGATOIRE :

📊 SCORE DE COMPATIBILITÉ GLOBAL : [X]/100

📈 RÉPARTITION PAR CATÉGORIE :
🎯 Compétences techniques requises (poids 35%) : [X]/35
   - [Compétence] : ✅/[Niveau] | ❌ manquant
   - [Compétence] : ✅/[Niveau] | ❌ manquant
   - [Compétence] : ✅/[Niveau] | ❌ manquant
🤝 Compétences interpersonnelles (poids 15%) : [X]/15
   - [Compétence] : ✅/[Niveau] | ❌ manquant
💼 Expérience professionnelle (poids 25%) : [X]/25
   - [Critère] : ✅/[Niveau] | ❌ manquant
🎓 Formation (poids 15%) : [X]/15
   - [Critère] : ✅/[Niveau] | ❌ manquant
🌍 Langues & Mobilité (poids 10%) : [X]/10
   - [Critère] : ✅/[Niveau] | ❌ manquant

✅ COMPÉTENCES CONCORDANTES (minimum 5)
- [Compétence] — Niveau de match : [Excellent/Bon/Moyen]
- [Compétence] — Niveau de match : [Excellent/Bon/Moyen]
- [Compétence] — Niveau de match : [Excellent/Bon/Moyen]
- [Compétence] — Niveau de match : [Excellent/Bon/Moyen]
- [Compétence] — Niveau de match : [Excellent/Bon/Moyen]

❌ COMPÉTENCES MANQUANTES OU INSUFFISANTES (minimum 3)
- [Compétence] — Importance : [Critique/Moyenne/Faible] — [Piste pour combler]
- [Compétence] — Importance : [Critique/Moyenne/Faible] — [Piste pour combler]
- [Compétence] — Importance : [Critique/Moyenne/Faible] — [Piste pour combler]

⚡ FORCES DU CANDIDAT POUR CE POSTE
- [Force 1 avec lien direct avec le poste]
- [Force 2 avec lien direct avec le poste]
- [Force 3 avec lien direct avec le poste]

⚠️ RISQUES POTENTIELS
- [Risque 1]
- [Risque 2]

💼 RECOMMANDATIONS POUR LA SUITE
🔴 Avant l'entretien :
1. [Action recommandée]
🟡 Pendant l'entretien :
1. [Point à approfondir]
2. [Point à vérifier]
🟢 Si embauché :
1. [Plan d'intégration suggéré]

🎯 VERDICT FINAL :
[Recommandé / À considérer avec réserves / Non recommandé pour ce poste]
[Justification en 1-2 phrases]

CV :
{$cvText}

DESCRIPTION DU POSTE :
{$jobDesc}"
            ]
        ], 4000);
    }

    public function generateOptimizedCV($cvText, $jobDesc)
    {
        return $this->callAI([
            [
                'role' => 'system',
                'content' =>
"Tu es un expert en rédaction de CV avec une expertise pointue en ATS (Applicant Tracking Systems).
Tu connais les algorithmes de parsing des ATS majeurs et les techniques d'optimisation pour passer leurs filtres.
Tu ne mens jamais — tu réorganises et reformules les informations existantes sans les inventer."
            ],
            [
                'role' => 'user',
                'content' =>
"Crée un CV OPTIMISÉ pour cette offre d'emploi basé sur le CV actuel du candidat.

RÈGLES STRICTES :
- Informations véridiques uniquement — ne jamais inventer d'expérience ou compétence
- Réorganiser et reformuler pour maximiser la pertinence avec l'offre
- Intégrer naturellement les mots-clés de l'offre dans les descriptions
- Structure ATS-friendly (sans tableaux, colonnes, graphiques, en-têtes/pieds de page)
- Format professionnel et percutant
- Chiffrer les réalisations quand l'info est disponible dans le CV original

FORMAT DE SORTIE (ATS-COMPATIBLE) :

=== INFORMATIONS PERSONNELLES ===
[Nom complet]
[Titre professionnel aligné avec l'offre]
[Téléphone] | [Email] | [Ville, Pays]
[LinkedIn] | [GitHub/Portfolio si pertinent]

=== RÉSUMÉ PROFESSIONNEL ===
[Résumé percutant de 4-5 lignes intégrant les mots-clés principaux de l'offre]
[Objectif professionnel aligné avec le poste visé]

=== COMPÉTENCES CLÉS ===
Techniques : [liste organisée par pertinence avec l'offre, mots-clés prioritaires en premier]
Méthodologies : [méthodologies pertinentes : Agile, DevOps, etc.]
Langues : [langue : niveau CECRL]
Certifications : [certifications pertinentes]

=== EXPÉRIENCE PROFESSIONNELLE ===
[Poste] | [Entreprise] | [Ville] | [Mois AAAA – Mois AAAA]
• [Réalisation chiffrée utilisant des mots-clés de l'offre]
• [Réalisation chiffrée alignée avec les exigences du poste]
• [Réalisation démontrant l'impact et les compétences recherchées]

[Répéter pour chaque expérience pertinente, ordre antéchronologique]
[Mettre en valeur les expériences les plus alignées avec l'offre]

=== FORMATION ===
[Diplôme] | [Établissement] | [Année]
[Spécialisation/matières pertinentes pour le poste]

=== CERTIFICATIONS & FORMATIONS COMPLÉMENTAIRES ===
[Certification] — [Organisme] — [Année]

=== LANGUES ===
[Langue maternelle] : Courant / Langue maternelle
[Langue 2] : Niveau (CECRL)

=== INFORMATIONS COMPLÉMENTAIRES ===
[Centres d'intérêt pertinents, bénévolat, projets personnels en lien avec le poste]

---

⚠️ NOTES D'OPTIMISATION ATS :
- Densité de mots-clés de l'offre dans le résumé : [%]
- Taux de couverture des compétences requises : [X]/[Total]
- Sections ATS-compatibles : ✅
- Recommandations supplémentaires : [1-2 conseils]

CV ACTUEL :
{$cvText}

OFFRE D'EMPLOI :
{$jobDesc}"
            ]
        ], 4000);
    }
}
