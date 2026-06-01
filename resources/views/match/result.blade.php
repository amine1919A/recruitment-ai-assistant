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
}

.match-result-page{
    min-height:100vh;
    background:var(--bg);
    padding:32px;
    color:var(--text);
    font-family:'DM Sans',sans-serif;
}

.match-result-container{
    max-width:1200px;
    margin:auto;
}

/* HERO */

.result-hero{
    position:relative;
    overflow:hidden;

    background:linear-gradient(
        135deg,
        rgba(59,130,246,.15),
        rgba(139,92,246,.15)
    );

    border:1px solid var(--border);
    border-radius:28px;

    padding:36px;
    margin-bottom:24px;
}

.result-hero::before{
    content:'';
    position:absolute;

    width:320px;
    height:320px;

    right:-120px;
    top:-120px;

    border-radius:50%;
    background:rgba(59,130,246,.15);

    filter:blur(100px);
}

.hero-content{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    gap:20px;
    flex-wrap:wrap;
}

.hero-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;

    background:rgba(59,130,246,.12);
    border:1px solid rgba(59,130,246,.2);

    color:var(--blue);

    padding:8px 14px;
    border-radius:30px;

    font-size:12px;
    font-weight:700;

    margin-bottom:16px;
}

.hero-title{
    font-size:38px;
    font-weight:800;
    margin-bottom:8px;
    letter-spacing:-1px;
}

.hero-subtitle{
    color:var(--text2);
    font-size:15px;
}

.hero-meta{
    margin-top:8px;
    color:var(--purple);
    font-size:13px;
    font-weight:700;
}

.back-btn{
    text-decoration:none;

    background:rgba(255,255,255,.05);
    border:1px solid var(--border);

    color:white;

    padding:12px 18px;
    border-radius:14px;

    font-weight:600;
    transition:.3s;
}

.back-btn:hover{
    background:rgba(255,255,255,.08);
}

/* RESULT CARD */

.result-card{
    background:var(--surface);
    border:1px solid var(--border);

    border-radius:28px;
    overflow:hidden;

    margin-bottom:24px;
}

.result-header{
    padding:24px 28px;
    border-bottom:1px solid var(--border);

    display:flex;
    align-items:center;
    gap:14px;
}

.ai-avatar{
    width:52px;
    height:52px;

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
    color:white;
}

.result-title{
    font-size:18px;
    font-weight:700;
}

.result-sub{
    color:var(--text3);
    font-size:13px;
    margin-top:4px;
}

.result-body{
    padding:30px;
}

.analysis-content{
    background:var(--surface2);
    border:1px solid var(--border);

    border-radius:20px;

    padding:24px;

    line-height:1.9;
    color:var(--text2);

    white-space:pre-wrap;
}

/* ACTIONS */

.action-card{
    background:var(--surface);
    border:1px solid var(--border);

    border-radius:24px;

    padding:24px;

    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
    flex-wrap:wrap;
}

.analysis-date{
    color:var(--text2);
}

.analysis-date strong{
    color:white;
}

.action-buttons{
    display:flex;
    gap:12px;
    flex-wrap:wrap;
}

.btn{
    border:none;
    text-decoration:none;
    cursor:pointer;

    display:inline-flex;
    align-items:center;
    justify-content:center;

    padding:14px 20px;
    border-radius:16px;

    font-size:14px;
    font-weight:700;

    transition:.3s;
}

.btn-copy{
    background:linear-gradient(
        135deg,
        #22C55E,
        #16A34A
    );
    color:white;
}

.btn-copy:hover{
    transform:translateY(-2px);
}

.btn-builder{
    background:linear-gradient(
        135deg,
        #F59E0B,
        #EA580C
    );
    color:white;
}

.btn-builder:hover{
    transform:translateY(-2px);
}

.btn-back{
    background:rgba(255,255,255,.05);
    border:1px solid var(--border);
    color:white;
}

.btn-back:hover{
    background:rgba(255,255,255,.08);
}

/* MOBILE */

@media(max-width:768px){

    .match-result-page{
        padding:20px;
    }

    .hero-title{
        font-size:30px;
    }

    .action-card{
        flex-direction:column;
        align-items:flex-start;
    }

    .action-buttons{
        width:100%;
        flex-direction:column;
    }

    .btn{
        width:100%;
    }
}
</style>

<div class="match-result-page">

    <div class="match-result-container">

        <!-- HERO -->

        <div class="result-hero">

            <div class="hero-content">

                <div>

                    <div class="hero-badge">
                        🤖 AI Matching Engine
                    </div>

                    <h1 class="hero-title">
                        Résultat du Matching
                    </h1>

                    <p class="hero-subtitle">
                        {{ basename($cv->file_path) }}
                    </p>

                    <div class="hero-meta">
                        Analyse IA générée automatiquement
                    </div>

                </div>

                <a href="{{ route('match.index') }}"
                   class="back-btn">
                    ← Retour
                </a>

            </div>

        </div>

        <!-- RESULT -->

        <div class="result-card">

            <div class="result-header">

                <div class="ai-avatar">
                    AI
                </div>

                <div>

                    <div class="result-title">
                        Analyse Détaillée
                    </div>

                    <div class="result-sub">
                        Compatibilité CV ↔ Offre d'emploi
                    </div>

                </div>

            </div>

            <div class="result-body">

                <div class="analysis-content" id="analysisContent">
                    {!! nl2br(e($result)) !!}
                </div>

            </div>

        </div>

        <!-- ACTIONS -->

        <div class="action-card">

            <div class="analysis-date">
                <strong>Analysé le :</strong>
                {{ $match->created_at->format('d/m/Y à H:i') }}
            </div>

            <div class="action-buttons">

                <button onclick="copyToClipboard(this)"
                        class="btn btn-copy">
                    📋 Copier
                </button>

                <a href="/cvbuilder/create?cv_id={{ $cv->id }}"
                   class="btn btn-builder">
                    ✨ Optimiser le CV
                </a>

                <a href="{{ route('match.index') }}"
                   class="btn btn-back">
                    Retour
                </a>

            </div>

        </div>

    </div>

</div>

<script>
function copyToClipboard(button){

    const text =
        document.getElementById('analysisContent').innerText;

    navigator.clipboard.writeText(text).then(() => {

        const original = button.innerHTML;

        button.innerHTML = '✅ Copié';

        setTimeout(() => {
            button.innerHTML = original;
        }, 2000);

    });

}
</script>

</x-app-layout>