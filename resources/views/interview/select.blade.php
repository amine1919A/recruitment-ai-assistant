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

.interview-start-page{
    min-height:100vh;
    background:var(--bg);
    padding:32px;
    color:var(--text);
    font-family:'DM Sans',sans-serif;
}

.interview-start-container{
    max-width:1200px;
    margin:auto;
}

/* HERO */

.start-hero{
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
    margin-bottom:28px;
}

.start-hero::before{
    content:'';
    position:absolute;
    width:320px;
    height:320px;
    right:-120px;
    top:-120px;
    border-radius:50%;
    background:rgba(59,130,246,.15);
    filter:blur(90px);
}

.hero-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;

    padding:8px 14px;

    border-radius:30px;

    background:rgba(59,130,246,.12);
    border:1px solid rgba(59,130,246,.2);

    color:var(--blue);

    font-size:12px;
    font-weight:700;

    margin-bottom:16px;
}

.hero-title{
    font-size:38px;
    font-weight:800;
    letter-spacing:-1px;
    margin-bottom:10px;
}

.hero-subtitle{
    color:var(--text2);
    max-width:700px;
    line-height:1.8;
}

/* CARD */

.cv-list-card{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:28px;
    overflow:hidden;
}

.cv-list-header{
    padding:24px 28px;
    border-bottom:1px solid var(--border);

    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:15px;
}

.cv-list-title{
    font-size:18px;
    font-weight:700;
}

.cv-count{
    background:rgba(59,130,246,.12);
    color:var(--blue);

    border:1px solid rgba(59,130,246,.2);

    padding:6px 14px;
    border-radius:30px;

    font-size:12px;
    font-weight:700;
}

/* CV ITEMS */

.cv-list{
    padding:20px;
}

.cv-item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:20px;

    padding:22px;

    border:1px solid var(--border);
    border-radius:22px;

    background:var(--surface2);

    text-decoration:none;
    color:white;

    margin-bottom:15px;

    transition:.3s;
}

.cv-item:last-child{
    margin-bottom:0;
}

.cv-item:hover{
    transform:translateY(-3px);

    border-color:rgba(59,130,246,.4);

    box-shadow:0 15px 35px rgba(0,0,0,.25);
}

.cv-left{
    display:flex;
    align-items:center;
    gap:16px;
}

.cv-icon{
    width:60px;
    height:60px;

    border-radius:18px;

    background:linear-gradient(
        135deg,
        #3B82F6,
        #8B5CF6
    );

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:24px;
    flex-shrink:0;
}

.cv-name{
    font-size:15px;
    font-weight:700;
    margin-bottom:6px;
}

.cv-date{
    font-size:13px;
    color:var(--text3);
}

.select-btn{
    display:flex;
    align-items:center;
    gap:8px;

    color:var(--blue);

    font-size:13px;
    font-weight:700;

    white-space:nowrap;
}

/* EMPTY */

.empty-state{
    text-align:center;
    padding:80px 30px;
}

.empty-icon{
    font-size:70px;
    margin-bottom:20px;
    opacity:.7;
}

.empty-title{
    font-size:24px;
    font-weight:700;
    margin-bottom:10px;
}

.empty-subtitle{
    color:var(--text2);
    max-width:500px;
    margin:auto;
    line-height:1.8;
    margin-bottom:30px;
}

.empty-btn{
    display:inline-flex;
    align-items:center;
    gap:10px;

    padding:15px 26px;

    border-radius:18px;

    background:linear-gradient(
        135deg,
        #3B82F6,
        #2563EB
    );

    color:white;
    text-decoration:none;

    font-weight:700;

    transition:.3s;
}

.empty-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 15px 30px rgba(59,130,246,.35);
}

/* MOBILE */

@media(max-width:768px){

    .interview-start-page{
        padding:20px;
    }

    .hero-title{
        font-size:30px;
    }

    .cv-item{
        flex-direction:column;
        align-items:flex-start;
    }

    .select-btn{
        width:100%;
        justify-content:flex-end;
    }
}
</style>

<div class="interview-start-page">

    <div class="interview-start-container">

        <!-- HERO -->

        <div class="start-hero">

            <div class="hero-badge">
                🎤 AI Interview System
            </div>

            <h1 class="hero-title">
                Démarrer une Interview IA
            </h1>

            <p class="hero-subtitle">
                Choisissez le CV que vous souhaitez utiliser pour générer une session
                d'entretien intelligente. Les questions seront adaptées à votre
                expérience, vos compétences et votre profil professionnel.
            </p>

        </div>

        <!-- CV LIST -->

        <div class="cv-list-card">

            <div class="cv-list-header">

                <div class="cv-list-title">
                    CV Disponibles
                </div>

                <div class="cv-count">
                    {{ $cvs->count() }} CV
                </div>

            </div>

            <div class="cv-list">

                @forelse($cvs as $cv)

                    <a href="/interview/start?cv_id={{ $cv->id }}"
                       class="cv-item">

                        <div class="cv-left">

                            <div class="cv-icon">
                                📄
                            </div>

                            <div>

                                <div class="cv-name">
                                    {{ basename($cv->file_path) }}
                                </div>

                                <div class="cv-date">
                                    Analysé {{ $cv->created_at->diffForHumans() }}
                                </div>

                            </div>

                        </div>

                        <div class="select-btn">
                            Sélectionner →
                        </div>

                    </a>

                @empty

                    <div class="empty-state">

                        <div class="empty-icon">
                            📄
                        </div>

                        <div class="empty-title">
                            Aucun CV disponible
                        </div>

                        <div class="empty-subtitle">
                            Vous devez analyser au moins un CV avant de pouvoir
                            démarrer une interview générée par intelligence artificielle.
                        </div>

                        <a href="/cv" class="empty-btn">
                            🚀 Analyser un CV
                        </a>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

</x-app-layout>