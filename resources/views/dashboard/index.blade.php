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
    --orange:#F97316;
}

.dashboard-page{
    min-height:100vh;
    background:var(--bg);
    padding:32px;
    color:var(--text);
    font-family:'DM Sans',sans-serif;
}

.dashboard-container{
    max-width:1500px;
    margin:auto;
}

/* HERO */

.hero-card{
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

.hero-card::before{
    content:'';
    position:absolute;
    right:-120px;
    top:-120px;

    width:300px;
    height:300px;

    border-radius:50%;

    background:rgba(59,130,246,.15);
    filter:blur(80px);
}

.hero-title{
    font-size:38px;
    font-weight:800;
    letter-spacing:-1px;
    margin-bottom:10px;
}

.hero-subtitle{
    color:var(--text2);
    max-width:650px;
    line-height:1.7;
}

/* STATS */

.stats-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-bottom:30px;
}

@media(max-width:1100px){
    .stats-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:650px){
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
    transform:translateY(-4px);
    border-color:rgba(59,130,246,.4);
}

.stat-icon{
    width:55px;
    height:55px;

    border-radius:15px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:24px;
    margin-bottom:15px;
}

.icon-blue{
    background:rgba(59,130,246,.15);
}

.icon-purple{
    background:rgba(139,92,246,.15);
}

.icon-green{
    background:rgba(34,197,94,.15);
}

.icon-orange{
    background:rgba(249,115,22,.15);
}

.stat-number{
    font-size:34px;
    font-weight:800;
}

.stat-label{
    color:var(--text2);
    margin-top:5px;
    font-size:14px;
}

/* ACTIONS */

.section-card{
    background:var(--surface);
    border:1px solid var(--border);
    border-radius:24px;
    padding:25px;
    margin-bottom:30px;
}

.section-title{
    font-size:18px;
    font-weight:700;
    margin-bottom:20px;
}

.actions-grid{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:15px;
}

@media(max-width:1100px){
    .actions-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:650px){
    .actions-grid{
        grid-template-columns:1fr;
    }
}

.action-card{
    background:var(--surface2);
    border:1px solid var(--border);

    border-radius:18px;
    padding:22px;

    text-decoration:none;
    color:white;

    transition:.3s;
}

.action-card:hover{
    transform:translateY(-3px);
    border-color:rgba(59,130,246,.4);
}

.action-icon{
    font-size:28px;
    margin-bottom:12px;
}

.action-label{
    font-weight:700;
}

/* LISTS */

.lists-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:24px;
}

@media(max-width:1000px){
    .lists-grid{
        grid-template-columns:1fr;
    }
}

.list-card{
    background:var(--surface);
    border:1px solid var(--border);

    border-radius:24px;
    overflow:hidden;
}

.list-header{
    padding:22px;
    border-bottom:1px solid var(--border);

    display:flex;
    justify-content:space-between;
    align-items:center;
}

.list-title{
    font-size:17px;
    font-weight:700;
}

.badge{
    background:rgba(59,130,246,.12);
    color:var(--blue);

    border:1px solid rgba(59,130,246,.2);

    padding:6px 12px;
    border-radius:30px;
    font-size:12px;
    font-weight:700;
}

.list-body{
    padding:18px;
}

.list-item{
    background:var(--surface2);
    border:1px solid var(--border);

    padding:14px 16px;
    border-radius:14px;

    margin-bottom:10px;

    transition:.25s;
}

.list-item:last-child{
    margin-bottom:0;
}

.list-item:hover{
    border-color:rgba(59,130,246,.3);
}

.item-title{
    font-size:14px;
    font-weight:600;
}

.empty-state{
    text-align:center;
    padding:40px;
    color:var(--text3);
}
</style>

<div class="dashboard-page">

    <div class="dashboard-container">

        <!-- HERO -->

        <div class="hero-card">

            <h1 class="hero-title">
                🚀 AI Recruitment Dashboard
            </h1>

            <p class="hero-subtitle">
                Gérez vos analyses de CV, interviews IA, matching de candidats et optimisations automatiques depuis une interface moderne inspirée des plateformes SaaS professionnelles.
            </p>

        </div>

        <!-- STATS -->

        <div class="stats-grid">

            <div class="stat-card">
                <div class="stat-icon icon-blue">📄</div>
                <div class="stat-number">{{ $cvs->count() }}</div>
                <div class="stat-label">CV Analysés</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-purple">🎤</div>
                <div class="stat-number">{{ $interviews->count() }}</div>
                <div class="stat-label">Interviews</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-green">🔍</div>
                <div class="stat-number">{{ $matches->count() }}</div>
                <div class="stat-label">Matches</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon icon-orange">✨</div>
                <div class="stat-number">{{ optional($optimizedCVs)->count() ?? 0 }}</div>
                <div class="stat-label">CV Optimisés</div>
            </div>

        </div>

        <!-- ACTIONS -->

        <div class="section-card">

            <div class="section-title">
                Actions Rapides
            </div>

            <div class="actions-grid">

                <a href="/cv" class="action-card">
                    <div class="action-icon">📄</div>
                    <div class="action-label">Analyse CV</div>
                </a>

                <a href="/interview" class="action-card">
                    <div class="action-icon">🎤</div>
                    <div class="action-label">Interview IA</div>
                </a>

                <a href="/match" class="action-card">
                    <div class="action-icon">🔍</div>
                    <div class="action-label">Matching</div>
                </a>

                <a href="/cvbuilder" class="action-card">
                    <div class="action-icon">✨</div>
                    <div class="action-label">CV Builder</div>
                </a>

                <a href="/admin" class="action-card">
                    <div class="action-icon">👔</div>
                    <div class="action-label">Administration</div>
                </a>

            </div>

        </div>

        <!-- LISTES -->

        <div class="lists-grid">

            <div class="list-card">

                <div class="list-header">
                    <div class="list-title">📄 Derniers CV</div>
                    <div class="badge">{{ $cvs->count() }}</div>
                </div>

                <div class="list-body">

                    @forelse($cvs->take(5) as $cv)

                        <div class="list-item">
                            <div class="item-title">
                                {{ basename($cv->file_path) }}
                            </div>
                        </div>

                    @empty

                        <div class="empty-state">
                            Aucun CV disponible
                        </div>

                    @endforelse

                </div>

            </div>

            <div class="list-card">

                <div class="list-header">
                    <div class="list-title">🎤 Dernières Interviews</div>
                    <div class="badge">{{ $interviews->count() }}</div>
                </div>

                <div class="list-body">

                    @forelse($interviews->take(5) as $i)

                        <div class="list-item">
                            <div class="item-title">
                                {{ \Illuminate\Support\Str::limit($i->question, 70) }}
                            </div>
                        </div>

                    @empty

                        <div class="empty-state">
                            Aucune interview disponible
                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>