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
    --red:#EF4444;
    --orange:#F59E0B;
}

.interview-live-page{
    min-height:100vh;
    background:var(--bg);
    padding:32px;
    color:var(--text);
    font-family:'DM Sans',sans-serif;
}

.interview-container{
    max-width:1400px;
    margin:auto;
}

.interview-grid{
    display:grid;
    grid-template-columns:340px 1fr;
    gap:24px;
}

@media(max-width:1100px){
    .interview-grid{
        grid-template-columns:1fr;
    }
}

/* HEADER */

.hero-card{
    background:linear-gradient(
        135deg,
        rgba(59,130,246,.15),
        rgba(139,92,246,.15)
    );

    border:1px solid var(--border);
    border-radius:28px;

    padding:30px;
    margin-bottom:25px;
}

.hero-content{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
    flex-wrap:wrap;
}

.hero-left{
    display:flex;
    align-items:center;
    gap:18px;
}

.ai-logo{
    width:70px;
    height:70px;
    border-radius:20px;

    background:linear-gradient(
        135deg,
        #3B82F6,
        #8B5CF6
    );

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:22px;
    font-weight:800;
}

.hero-title{
    font-size:28px;
    font-weight:800;
    margin-bottom:5px;
}

.hero-sub{
    color:var(--text2);
    font-size:14px;
}

.question-number{
    margin-top:6px;
    color:var(--purple);
    font-size:13px;
    font-weight:700;
}

.quit-btn{
    text-decoration:none;
    color:white;

    padding:12px 18px;

    background:rgba(255,255,255,.05);
    border:1px solid var(--border);

    border-radius:14px;
    transition:.3s;
}

.quit-btn:hover{
    background:rgba(255,255,255,.08);
}

/* PROGRESS */

.progress-card{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:18px;

    padding:18px;
    margin-bottom:24px;
}

.progress-head{
    display:flex;
    justify-content:space-between;
    margin-bottom:10px;

    color:var(--text2);
    font-size:13px;
}

.progress{
    height:10px;
    background:rgba(255,255,255,.05);
    border-radius:30px;
    overflow:hidden;
}

.progress-bar{
    height:100%;

    background:linear-gradient(
        90deg,
        #3B82F6,
        #8B5CF6
    );

    border-radius:30px;
}

/* SIDEBAR */

.sidebar-card{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:24px;
    overflow:hidden;
}

.sidebar-header{
    padding:22px;
    border-bottom:1px solid var(--border);
}

.sidebar-title{
    font-size:17px;
    font-weight:700;
}

.history-list{
    padding:18px;
}

.history-item{
    background:var(--surface2);
    border:1px solid var(--border);

    border-radius:16px;
    padding:14px;
    margin-bottom:12px;
}

.history-item:last-child{
    margin-bottom:0;
}

.q-badge{
    display:inline-flex;
    align-items:center;
    justify-content:center;

    padding:5px 10px;

    background:rgba(255,255,255,.05);
    border-radius:30px;

    font-size:11px;
    font-weight:700;
}

.score-badge{
    float:right;
    padding:5px 10px;
    border-radius:30px;
    font-size:11px;
    font-weight:700;
}

.good{
    background:rgba(34,197,94,.12);
    color:var(--green);
}

.medium{
    background:rgba(245,158,11,.12);
    color:var(--orange);
}

.bad{
    background:rgba(239,68,68,.12);
    color:var(--red);
}

.history-question{
    margin-top:12px;
    color:var(--text2);
    font-size:13px;
    line-height:1.6;
}

/* MAIN */

.main-card{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:24px;
    overflow:hidden;
}

.question-card{
    padding:28px;
    border-bottom:1px solid var(--border);
}

.question-top{
    display:flex;
    gap:15px;
}

.ai-avatar{
    width:55px;
    height:55px;

    flex-shrink:0;

    border-radius:16px;

    background:linear-gradient(
        135deg,
        #3B82F6,
        #8B5CF6
    );

    display:flex;
    align-items:center;
    justify-content:center;

    font-weight:800;
}

.ai-label{
    color:var(--purple);
    font-size:13px;
    font-weight:700;
    margin-bottom:8px;
}

.question-text{
    font-size:20px;
    line-height:1.7;
    font-weight:600;
}

.form-section{
    padding:28px;
}

.form-title{
    font-size:18px;
    font-weight:700;
    margin-bottom:15px;
}

.answer-box{
    width:100%;
    min-height:220px;

    background:var(--surface2);
    border:1px solid var(--border);

    color:white;

    border-radius:18px;
    padding:18px;

    resize:none;
    outline:none;

    font-family:inherit;
}

.answer-box:focus{
    border-color:var(--blue);
    box-shadow:0 0 0 4px rgba(59,130,246,.1);
}

.form-footer{
    display:flex;
    justify-content:space-between;
    margin-top:10px;

    color:var(--text3);
    font-size:13px;
}

/* BUTTONS */

.action-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
    margin-top:25px;
}

.finish-btn,
.next-btn{
    border:none;
    border-radius:18px;
    padding:16px;

    font-size:15px;
    font-weight:700;

    cursor:pointer;
    transition:.3s;
}

.finish-btn{
    background:linear-gradient(
        135deg,
        #22C55E,
        #16A34A
    );
    color:white;
}

.next-btn{
    background:linear-gradient(
        135deg,
        #3B82F6,
        #8B5CF6
    );
    color:white;
}

.finish-btn:hover,
.next-btn:hover{
    transform:translateY(-2px);
}

/* TIPS */

.tips-card{
    margin-top:24px;

    background:rgba(59,130,246,.08);
    border:1px solid rgba(59,130,246,.15);

    border-radius:24px;
    padding:22px;
}

.tips-title{
    font-size:16px;
    font-weight:700;
    margin-bottom:15px;
}

.tip{
    color:var(--text2);
    margin-bottom:10px;
}
</style>

<div class="interview-live-page">

    <div class="interview-container">

        <!-- HERO -->

        <div class="hero-card">

            <div class="hero-content">

                <div class="hero-left">

                    <div class="ai-logo">
                        AI
                    </div>

                    <div>

                        <div class="hero-title">
                            🎤 Live Interview Session
                        </div>

                        <div class="hero-sub">
                            CV : {{ basename($cv->file_path) }}
                        </div>

                        @if(isset($questionNumber))
                            <div class="question-number">
                                Question {{ $questionNumber }}/10
                            </div>
                        @endif

                    </div>

                </div>

                <a href="/interview" class="quit-btn">
                    ✕ Quitter
                </a>

            </div>

        </div>

        <!-- PROGRESS -->

        @if(isset($questionNumber))
        <div class="progress-card">

            <div class="progress-head">
                <span>Progression</span>
                <span>{{ $questionNumber }}/10</span>
            </div>

            <div class="progress">
                <div class="progress-bar"
                     style="width: {{ ($questionNumber / 10) * 100 }}%">
                </div>
            </div>

        </div>
        @endif

        <div class="interview-grid">

            <!-- HISTORY -->

            @if(isset($history) && count($history) > 0)

            <div class="sidebar-card">

                <div class="sidebar-header">
                    <div class="sidebar-title">
                        Historique Session
                    </div>
                </div>

                <div class="history-list">

                    @foreach($history as $index => $item)

                    <div class="history-item">

                        <span class="q-badge">
                            Q{{ $index+1 }}
                        </span>

                        <span class="score-badge
                        {{ $item['score'] >= 7 ? 'good' :
                        ($item['score'] >= 5 ? 'medium' : 'bad') }}">
                            {{ $item['score'] }}/10
                        </span>

                        <div class="history-question">
                            {{ $item['question'] }}
                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

            @endif

            <!-- MAIN -->

            <div>

                <div class="main-card">

                    <div class="question-card">

                        <div class="question-top">

                            <div class="ai-avatar">
                                AI
                            </div>

                            <div>

                                <div class="ai-label">
                                    Recruteur IA
                                </div>

                                <div class="question-text">
                                    {{ $question }}
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="form-section">

                        <form action="/interview/submit"
                              method="POST"
                              id="answerForm">

                            @csrf

                            <input type="hidden"
                                   name="question"
                                   value="{{ $question }}">

                            <div class="form-title">
                                Votre réponse
                            </div>

                            <textarea
                                name="answer"
                                id="answerText"
                                required
                                minlength="20"
                                class="answer-box"
                                placeholder="Décrivez votre expérience, vos compétences et votre approche..."></textarea>

                            <div class="form-footer">
                                <span>Minimum 20 caractères</span>
                                <span id="charCount">0</span>
                            </div>

                            <div class="action-grid">

                                <button type="submit"
                                        name="finish"
                                        value="1"
                                        class="finish-btn">
                                    ✓ Terminer l'entretien
                                </button>

                                <button type="submit"
                                        name="continue"
                                        value="1"
                                        class="next-btn">
                                    → Question suivante
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

                <div class="tips-card">

                    <div class="tips-title">
                        💡 Conseils IA
                    </div>

                    <div class="tip">
                        ✔ Utilisez la méthode STAR (Situation, Tâche, Action, Résultat)
                    </div>

                    <div class="tip">
                        ✔ Donnez des exemples réels et mesurables
                    </div>

                    <div class="tip">
                        ✔ Mettez en avant votre impact et vos réalisations
                    </div>

                    <div class="tip">
                        ✔ Restez précis, professionnel et structuré
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
const textarea = document.getElementById('answerText');
const charCount = document.getElementById('charCount');

textarea.addEventListener('input', () => {
    charCount.textContent = textarea.value.length;
    localStorage.setItem('interview_answer', textarea.value);
});

window.addEventListener('load', () => {
    const saved = localStorage.getItem('interview_answer');

    if(saved){
        textarea.value = saved;
        charCount.textContent = saved.length;
    }
});

document.getElementById('answerForm')
.addEventListener('submit', () => {
    localStorage.removeItem('interview_answer');
});
</script>

</x-app-layout>