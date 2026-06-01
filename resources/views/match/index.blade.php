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

.match-page{
    min-height:100vh;
    background:var(--bg);
    padding:32px;
    color:var(--text);
    font-family:'DM Sans',sans-serif;
}

.match-container{
    max-width:1400px;
    margin:auto;
}

/* HERO */

.match-hero{
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

.match-hero::before{
    content:'';
    position:absolute;
    width:350px;
    height:350px;
    top:-150px;
    right:-150px;
    border-radius:50%;
    background:rgba(59,130,246,.15);
    filter:blur(100px);
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
    font-size:40px;
    font-weight:800;
    margin-bottom:10px;
    letter-spacing:-1px;
}

.hero-subtitle{
    max-width:750px;
    color:var(--text2);
    line-height:1.8;
}

/* ALERT */

.alert-error{
    margin-bottom:24px;

    background:rgba(239,68,68,.1);
    border:1px solid rgba(239,68,68,.2);

    color:var(--red);

    padding:16px 20px;
    border-radius:18px;
}

/* GRID */

.match-grid{
    display:grid;
    grid-template-columns:1.1fr .9fr;
    gap:24px;
}

@media(max-width:1100px){
    .match-grid{
        grid-template-columns:1fr;
    }
}

/* CARD */

.card{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:24px;
    overflow:hidden;
}

.card-header{
    padding:24px;
    border-bottom:1px solid var(--border);
}

.card-title{
    font-size:18px;
    font-weight:700;
}

.card-subtitle{
    color:var(--text3);
    font-size:13px;
    margin-top:5px;
}

.card-body{
    padding:24px;
}

/* FORM */

.form-group{
    margin-bottom:22px;
}

.form-label{
    display:block;
    margin-bottom:10px;

    color:var(--text);
    font-weight:600;
}

.form-input,
.form-select,
.form-textarea{
    width:100%;

    background:var(--surface2);
    border:1px solid var(--border);

    color:white;

    border-radius:16px;
    padding:14px 16px;

    font-family:inherit;
    outline:none;

    transition:.25s;
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus{
    border-color:var(--blue);
    box-shadow:0 0 0 4px rgba(59,130,246,.1);
}

.form-textarea{
    min-height:260px;
    resize:vertical;
}

.error-text{
    color:var(--red);
    font-size:13px;
    margin-top:8px;
}

.submit-btn{
    width:100%;

    border:none;
    cursor:pointer;

    background:linear-gradient(
        135deg,
        #3B82F6,
        #8B5CF6
    );

    color:white;

    padding:16px;
    border-radius:18px;

    font-size:15px;
    font-weight:700;

    transition:.3s;
}

.submit-btn:hover{
    transform:translateY(-2px);
    box-shadow:0 18px 35px rgba(59,130,246,.35);
}

/* HISTORY */

.history-list{
    padding:20px;
}

.match-item{
    background:var(--surface2);
    border:1px solid var(--border);

    border-radius:18px;
    padding:18px;

    margin-bottom:15px;
    transition:.25s;
}

.match-item:last-child{
    margin-bottom:0;
}

.match-item:hover{
    border-color:rgba(59,130,246,.3);
}

.match-file{
    font-weight:700;
    margin-bottom:10px;
}

.match-desc{
    color:var(--text2);
    line-height:1.7;
    font-size:13px;
    margin-bottom:10px;
}

.match-date{
    color:var(--text3);
    font-size:12px;
}

.match-footer{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:14px;
}

.view-btn{
    text-decoration:none;

    background:rgba(59,130,246,.12);
    color:var(--blue);

    border:1px solid rgba(59,130,246,.2);

    padding:8px 14px;
    border-radius:12px;

    font-size:13px;
    font-weight:700;
}

.view-btn:hover{
    background:rgba(59,130,246,.18);
}

/* EMPTY */

.empty-state{
    text-align:center;
    padding:60px 20px;
}

.empty-icon{
    font-size:60px;
    margin-bottom:16px;
}

.empty-title{
    font-size:18px;
    font-weight:700;
    margin-bottom:8px;
}

.empty-subtitle{
    color:var(--text3);
    line-height:1.7;
}

.upload-btn{
    display:inline-flex;
    margin-top:22px;

    text-decoration:none;

    background:linear-gradient(
        135deg,
        #3B82F6,
        #2563EB
    );

    color:white;

    padding:14px 20px;
    border-radius:16px;

    font-weight:700;
}

/* WARNING */

.warning-box{
    margin-top:24px;

    background:rgba(245,158,11,.1);
    border:1px solid rgba(245,158,11,.2);

    color:var(--orange);

    padding:18px;
    border-radius:18px;
}
</style>

<div class="match-page">

    <div class="match-container">

        <!-- HERO -->

        <div class="match-hero">

            <div class="hero-badge">
                🤖 AI Matching Engine
            </div>

            <h1 class="hero-title">
                Job Matching AI
            </h1>

            <p class="hero-subtitle">
                Comparez automatiquement les compétences de vos CV avec une offre
                d'emploi grâce à l'intelligence artificielle. Analyse avancée,
                compatibilité, points forts et axes d'amélioration.
            </p>

        </div>

        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        <div class="match-grid">

            <!-- FORM -->

            <div class="card">

                <div class="card-header">
                    <div class="card-title">
                        🔍 Nouvelle Analyse
                    </div>

                    <div class="card-subtitle">
                        Sélectionnez un CV puis ajoutez une offre d'emploi.
                    </div>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('match.analyze') }}">
                        @csrf

                        <div class="form-group">

                            <label class="form-label">
                                📄 Sélection du CV
                            </label>

                            <select name="cv_id"
                                    required
                                    class="form-select">

                                <option value="">
                                    Choisir un CV
                                </option>

                                @foreach($cvs as $cv)
                                    <option value="{{ $cv->id }}">
                                        {{ basename($cv->file_path) }}
                                    </option>
                                @endforeach

                            </select>

                            @error('cv_id')
                                <div class="error-text">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <div class="form-group">

                            <label class="form-label">
                                💼 Description du Poste
                            </label>

                            <textarea
                                name="job_description"
                                required
                                class="form-textarea"
                                placeholder="Collez ici l'offre d'emploi complète..."></textarea>

                            @error('job_description')
                                <div class="error-text">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        <button type="submit"
                                class="submit-btn">
                            🚀 Lancer l'Analyse IA
                        </button>

                    </form>

                </div>

            </div>

            <!-- HISTORY -->

            <div class="card">

                <div class="card-header">
                    <div class="card-title">
                        📋 Historique des Matchings
                    </div>

                    <div class="card-subtitle">
                        Dernières analyses effectuées
                    </div>
                </div>

                <div class="history-list">

                    @forelse($matches as $match)

                        <div class="match-item">

                            <div class="match-file">
                                📄 {{ basename($match->cv->file_path) }}
                            </div>

                            <div class="match-desc">
                                {{ \Illuminate\Support\Str::limit($match->job_description, 120) }}
                            </div>

                            <div class="match-date">
                                {{ $match->created_at->diffForHumans() }}
                            </div>

                            <div class="match-footer">

                                <div></div>

                                <a href="{{ route('match.index') }}#match-{{ $match->id }}"
                                   class="view-btn">
                                    Voir →
                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="empty-state">

                            <div class="empty-icon">
                                🔍
                            </div>

                            <div class="empty-title">
                                Aucun matching disponible
                            </div>

                            <div class="empty-subtitle">
                                Lancez votre première analyse de compatibilité
                                entre CV et offre d'emploi.
                            </div>

                            @if($cvs->isEmpty())
                                <a href="/cv" class="upload-btn">
                                    📄 Uploader un CV
                                </a>
                            @endif

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

        @if($cvs->isEmpty())

            <div class="warning-box">
                ⚠️ Aucun CV disponible. Analysez un CV avant d'utiliser le système de Job Matching IA.
            </div>

        @endif

    </div>

</div>

</x-app-layout>