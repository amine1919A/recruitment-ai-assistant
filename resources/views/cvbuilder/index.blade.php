<x-app-layout>

<style>
:root{
    --bg:#0F1117;
    --surface:#181C27;
    --surface2:#1E2235;
    --border:#2A2F45;

    --blue:#3B82F6;
    --purple:#8B5CF6;
    --orange:#F97316;
    --green:#22C55E;

    --text:#F8FAFC;
    --text2:#94A3B8;
    --text3:#64748B;
}

.cvbuilder-page{
    min-height:100vh;
    background:var(--bg);
    padding:32px;
    color:var(--text);
    font-family:'DM Sans',sans-serif;
}

.cvbuilder-container{
    max-width:1400px;
    margin:auto;
}

/* HERO */

.hero-section{
    background:linear-gradient(
        135deg,
        rgba(59,130,246,.15),
        rgba(139,92,246,.15)
    );

    border:1px solid var(--border);
    border-radius:24px;
    padding:35px;
    margin-bottom:25px;

    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:20px;
}

.hero-title{
    font-size:32px;
    font-weight:800;
    letter-spacing:-1px;
    margin-bottom:8px;
}

.hero-subtitle{
    color:var(--text2);
    font-size:14px;
}

.create-btn{
    display:inline-flex;
    align-items:center;
    gap:10px;
    padding:14px 24px;
    border-radius:14px;
    text-decoration:none;
    font-weight:700;
    color:white;

    background:linear-gradient(
        135deg,
        #F97316,
        #EA580C
    );

    transition:.3s;
}

.create-btn:hover{
    transform:translateY(-3px);
    box-shadow:0 15px 35px rgba(249,115,22,.35);
}

/* GRID */

.dashboard-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:24px;
}

@media(max-width:1100px){
    .dashboard-grid{
        grid-template-columns:1fr;
    }
}

/* CARD */

.dashboard-card{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:22px;
    overflow:hidden;
}

.card-header{
    padding:22px 24px;
    border-bottom:1px solid var(--border);
    display:flex;
    align-items:center;
    justify-content:space-between;
}

.card-title-wrap{
    display:flex;
    align-items:center;
    gap:12px;
}

.card-icon{
    width:46px;
    height:46px;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
    color:white;
    flex-shrink:0;
}

.icon-orange{
    background:linear-gradient(
        135deg,
        #F97316,
        #EF4444
    );
}

.icon-purple{
    background:linear-gradient(
        135deg,
        #6366F1,
        #8B5CF6
    );
}

.card-title{
    font-size:17px;
    font-weight:700;
}

.card-subtitle{
    color:var(--text3);
    font-size:12px;
    margin-top:3px;
}

.badge{
    padding:6px 12px;
    border-radius:30px;
    font-size:12px;
    font-weight:700;

    background:rgba(59,130,246,.12);
    border:1px solid rgba(59,130,246,.2);
    color:var(--blue);
}

/* LIST */

.cv-list{
    padding:18px;
}

.cv-item{
    background:var(--surface2);
    border:1px solid var(--border);

    border-radius:16px;
    padding:16px;
    margin-bottom:12px;

    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:15px;

    transition:.25s;
}

.cv-item:last-child{
    margin-bottom:0;
}

.cv-item:hover{
    transform:translateY(-2px);
    border-color:rgba(59,130,246,.3);
}

.cv-left{
    display:flex;
    align-items:center;
    gap:14px;
}

.cv-avatar{
    width:50px;
    height:50px;
    border-radius:14px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:14px;
    font-weight:700;
    flex-shrink:0;
}

.avatar-ai{
    background:rgba(249,115,22,.12);
    color:var(--orange);
    border:1px solid rgba(249,115,22,.2);
}

.avatar-pdf{
    background:rgba(139,92,246,.12);
    color:var(--purple);
    border:1px solid rgba(139,92,246,.2);
}

.cv-name{
    font-size:14px;
    font-weight:700;
    color:var(--text);
}

.cv-date{
    font-size:12px;
    color:var(--text3);
    margin-top:4px;
}

.edit-btn{
    display:inline-flex;
    align-items:center;
    gap:8px;

    padding:10px 18px;
    border-radius:12px;

    text-decoration:none;
    font-size:13px;
    font-weight:700;

    background:rgba(59,130,246,.12);
    border:1px solid rgba(59,130,246,.2);
    color:var(--blue);

    transition:.25s;
}

.edit-btn:hover{
    background:rgba(59,130,246,.2);
}

.empty-state{
    text-align:center;
    padding:60px 20px;
}

.empty-icon{
    font-size:48px;
    margin-bottom:12px;
    opacity:.5;
}

.empty-title{
    color:var(--text2);
    font-weight:700;
}

.empty-sub{
    color:var(--text3);
    font-size:13px;
    margin-top:6px;
}
</style>

<div class="cvbuilder-page">

    <div class="cvbuilder-container">

        <!-- HERO -->

        <div class="hero-section">

            <div>
                <h1 class="hero-title">
                    ✨ CV Builder AI
                </h1>

                <p class="hero-subtitle">
                    Créez, optimisez et gérez vos CV avec l'intelligence artificielle.
                </p>
            </div>

            <a href="/cvbuilder/create" class="create-btn">
                ➕ Créer un CV
            </a>

        </div>

        <!-- GRID -->

        <div class="dashboard-grid">

            <!-- CV OPTIMISES -->

            <div class="dashboard-card">

                <div class="card-header">

                    <div class="card-title-wrap">

                        <div class="card-icon icon-orange">
                            🤖
                        </div>

                        <div>
                            <div class="card-title">
                                CV Optimisés
                            </div>

                            <div class="card-subtitle">
                                Générés et améliorés par IA
                            </div>
                        </div>

                    </div>

                    <div class="badge">
                        {{ $optimizedCVs->count() }}
                    </div>

                </div>

                <div class="cv-list">

                    @forelse($optimizedCVs as $opt)

                        <div class="cv-item">

                            <div class="cv-left">

                                <div class="cv-avatar avatar-ai">
                                    AI
                                </div>

                                <div>
                                    <div class="cv-name">
                                        {{ basename($opt->cv->file_path) }}
                                    </div>

                                    <div class="cv-date">
                                        {{ $opt->created_at->diffForHumans() }}
                                    </div>
                                </div>

                            </div>

                            <a href="/cvbuilder/{{ $opt->id }}/edit"
                               class="edit-btn">
                                ✏️ Modifier
                            </a>

                        </div>

                    @empty

                        <div class="empty-state">
                            <div class="empty-icon">🤖</div>
                            <div class="empty-title">
                                Aucun CV optimisé
                            </div>
                            <div class="empty-sub">
                                Commencez par optimiser votre premier CV.
                            </div>
                        </div>

                    @endforelse

                </div>

            </div>

            <!-- CV SOURCES -->

            <div class="dashboard-card">

                <div class="card-header">

                    <div class="card-title-wrap">

                        <div class="card-icon icon-purple">
                            📄
                        </div>

                        <div>
                            <div class="card-title">
                                CV Sources
                            </div>

                            <div class="card-subtitle">
                                CV importés dans le système
                            </div>
                        </div>

                    </div>

                    <div class="badge">
                        {{ $cvs->count() }}
                    </div>

                </div>

                <div class="cv-list">

                    @forelse($cvs as $cv)

                        <div class="cv-item">

                            <div class="cv-left">

                                <div class="cv-avatar avatar-pdf">
                                    PDF
                                </div>

                                <div>
                                    <div class="cv-name">
                                        {{ basename($cv->file_path) }}
                                    </div>

                                    <div class="cv-date">
                                        {{ $cv->created_at->diffForHumans() }}
                                    </div>
                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="empty-state">
                            <div class="empty-icon">📄</div>
                            <div class="empty-title">
                                Aucun CV source
                            </div>
                            <div class="empty-sub">
                                Importez un CV pour commencer.
                            </div>
                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>