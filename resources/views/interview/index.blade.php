<x-app-layout>

<style>
:root{
    --bg:#0B1120;
    --surface:#111827;
    --surface2:#182033;
    --border:#25304A;

    --text:#F8FAFC;
    --text2:#94A3B8;
    --text3:#64748B;

    --blue:#3B82F6;
    --purple:#8B5CF6;
    --green:#22C55E;
    --orange:#F59E0B;
    --red:#EF4444;
}

.interview-page{
    min-height:100vh;
    background:var(--bg);
    padding:32px;
    color:var(--text);
    font-family:'DM Sans',sans-serif;
}

.interview-container{
    max-width:1500px;
    margin:auto;
}

/* HERO */

.interview-hero{
    position:relative;
    overflow:hidden;

    background:linear-gradient(
        135deg,
        rgba(59,130,246,.15),
        rgba(139,92,246,.15)
    );

    border:1px solid var(--border);
    border-radius:28px;

    padding:40px;
    margin-bottom:30px;
}

.interview-hero::before{
    content:'';
    position:absolute;
    width:320px;
    height:320px;
    right:-120px;
    top:-120px;
    border-radius:50%;
    background:rgba(59,130,246,.12);
    filter:blur(90px);
}

.hero-content{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
    flex-wrap:wrap;
}

.hero-title{
    font-size:38px;
    font-weight:800;
    letter-spacing:-1px;
    margin-bottom:8px;
}

.hero-subtitle{
    color:var(--text2);
    max-width:650px;
    line-height:1.7;
}

.start-btn{
    display:inline-flex;
    align-items:center;
    gap:10px;

    background:linear-gradient(
        135deg,
        #3B82F6,
        #2563EB
    );

    color:white;
    text-decoration:none;

    padding:15px 28px;
    border-radius:16px;

    font-weight:700;
    transition:.3s;
}

.start-btn:hover{
    transform:translateY(-3px);
    box-shadow:0 20px 35px rgba(59,130,246,.35);
}

/* SUCCESS */

.success-alert{
    margin-bottom:25px;

    background:rgba(34,197,94,.1);
    border:1px solid rgba(34,197,94,.2);

    color:var(--green);

    padding:15px 20px;
    border-radius:16px;
}

/* STATS */

.stats-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
    margin-bottom:30px;
}

@media(max-width:900px){
    .stats-grid{
        grid-template-columns:1fr;
    }
}

.stat-card{
    background:var(--surface);
    border:1px solid var(--border);

    border-radius:22px;
    padding:25px;

    transition:.3s;
}

.stat-card:hover{
    transform:translateY(-3px);
    border-color:rgba(59,130,246,.3);
}

.stat-label{
    color:var(--text2);
    font-size:14px;
}

.stat-value{
    font-size:34px;
    font-weight:800;
    margin-top:8px;
}

/* HISTORY */

.history-card{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:24px;
    overflow:hidden;
}

.history-header{
    padding:24px;
    border-bottom:1px solid var(--border);

    display:flex;
    justify-content:space-between;
    align-items:center;
}

.history-title{
    font-size:18px;
    font-weight:700;
}

.count-badge{
    background:rgba(59,130,246,.12);
    color:var(--blue);

    border:1px solid rgba(59,130,246,.2);

    padding:6px 12px;
    border-radius:30px;

    font-size:12px;
    font-weight:700;
}

/* INTERVIEW ITEM */

.interview-item{
    padding:24px;
    border-bottom:1px solid var(--border);
    transition:.25s;
}

.interview-item:last-child{
    border-bottom:none;
}

.interview-item:hover{
    background:rgba(255,255,255,.015);
}

.item-top{
    display:flex;
    gap:16px;
}

.ai-avatar{
    width:50px;
    height:50px;

    flex-shrink:0;

    border-radius:14px;

    background:linear-gradient(
        135deg,
        #3B82F6,
        #8B5CF6
    );

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:13px;
    font-weight:800;
}

.item-content{
    flex:1;
}

.question-row{
    display:flex;
    justify-content:space-between;
    gap:20px;
    align-items:flex-start;
}

.question{
    font-size:15px;
    font-weight:700;
    line-height:1.6;
}

.date{
    margin-top:6px;
    font-size:12px;
    color:var(--text3);
}

/* SCORE */

.score{
    padding:8px 14px;
    border-radius:30px;
    font-size:13px;
    font-weight:700;
    white-space:nowrap;
}

.score-good{
    background:rgba(34,197,94,.12);
    color:var(--green);
}

.score-medium{
    background:rgba(245,158,11,.12);
    color:var(--orange);
}

.score-bad{
    background:rgba(239,68,68,.12);
    color:var(--red);
}

/* ANSWER */

.answer-box{
    margin-top:18px;

    background:var(--surface2);
    border:1px solid var(--border);

    border-radius:16px;
    padding:18px;
}

.answer-title{
    color:var(--blue);
    font-size:13px;
    font-weight:700;
    margin-bottom:10px;
}

.answer-text{
    color:var(--text2);
    line-height:1.8;
}

/* FEEDBACK */

.feedback-box{
    margin-top:15px;

    background:rgba(59,130,246,.08);
    border:1px solid rgba(59,130,246,.15);

    border-radius:16px;
    padding:18px;
}

.feedback-title{
    color:var(--blue);
    font-size:13px;
    font-weight:700;
    margin-bottom:10px;
}

.feedback-text{
    color:var(--text);
    line-height:1.8;
    white-space:pre-line;
}

.empty-state{
    text-align:center;
    padding:70px 30px;
}

.empty-icon{
    font-size:50px;
    opacity:.5;
    margin-bottom:12px;
}

.empty-title{
    font-size:16px;
    font-weight:700;
    color:var(--text2);
}

.empty-sub{
    color:var(--text3);
    margin-top:5px;
}
</style>

<div class="interview-page">

    <div class="interview-container">

        <!-- HERO -->

        <div class="interview-hero">

            <div class="hero-content">

                <div>

                    <h1 class="hero-title">
                        🎤 AI Interview Simulator
                    </h1>

                    <p class="hero-subtitle">
                        Préparez vos entretiens avec une intelligence artificielle avancée.
                        Analyse des réponses, notation automatique et recommandations personnalisées.
                    </p>

                </div>

                @if($cvs->count() > 0)
                    <a href="/interview/start" class="start-btn">
                        ▶ Démarrer Interview
                    </a>
                @endif

            </div>

        </div>

        <!-- SUCCESS -->

        @if(session('success'))
            <div class="success-alert">
                ✓ {{ session('success') }}
            </div>
        @endif

        <!-- STATS -->

        <div class="stats-grid">

            <div class="stat-card">
                <div class="stat-label">
                    Total Interviews
                </div>
                <div class="stat-value">
                    {{ $totalInterviews }}
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-label">
                    Score Moyen
                </div>
                <div class="stat-value">
                    {{ number_format($avgScore,1) }}/10
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-label">
                    Meilleur Score
                </div>
                <div class="stat-value">
                    {{ $bestScore }}/10
                </div>
            </div>

        </div>

        <!-- HISTORY -->

        <div class="history-card">

            <div class="history-header">

                <div class="history-title">
                    Historique des Interviews
                </div>

                <div class="count-badge">
                    {{ $interviews->count() }} Sessions
                </div>

            </div>

            @forelse($interviews as $interview)

                <div class="interview-item">

                    <div class="item-top">

                        <div class="ai-avatar">
                            AI
                        </div>

                        <div class="item-content">

                            <div class="question-row">

                                <div>

                                    <div class="question">
                                        {{ $interview->question }}
                                    </div>

                                    <div class="date">
                                        {{ $interview->created_at->diffForHumans() }}
                                    </div>

                                </div>

                                <div class="score
                                    {{ $interview->score >= 7 ? 'score-good' :
                                       ($interview->score >= 5 ? 'score-medium' : 'score-bad') }}">
                                    {{ $interview->score }}/10
                                </div>

                            </div>

                            <div class="answer-box">

                                <div class="answer-title">
                                    Votre Réponse
                                </div>

                                <div class="answer-text">
                                    {{ $interview->answer }}
                                </div>

                            </div>

                            @if($interview->feedback)

                                <div class="feedback-box">

                                    <div class="feedback-title">
                                        🤖 Feedback IA
                                    </div>

                                    <div class="feedback-text">
                                        {{ $interview->feedback }}
                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            @empty

                <div class="empty-state">

                    <div class="empty-icon">
                        🎤
                    </div>

                    <div class="empty-title">
                        Aucun entretien disponible
                    </div>

                    <div class="empty-sub">
                        Lancez votre premier entretien IA pour commencer.
                    </div>

                </div>

            @endforelse

        </div>

    </div>

</div>

</x-app-layout>