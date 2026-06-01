<x-app-layout>
<style>
:root {
  --bg: #0F1117; --surface: #181C27; --surface2: #1E2235;
  --border: #2A2F45; --blue: #3B7FFF; --blue-dim: rgba(59,127,255,.12);
  --text: #E8EBF4; --text2: #8B92AB; --text3: #4B5268;
  --red: #EF4444; --green: #22C55E;
}
.page { background: var(--bg); min-height: 100vh; padding: 32px 28px; font-family: 'DM Sans', sans-serif; color: var(--text); }
.page-header { margin-bottom: 28px; }
.page-title { font-size: 22px; font-weight: 700; color: var(--text); letter-spacing: -.4px; }
.page-sub { font-size: 14px; color: var(--text2); margin-top: 4px; }

/* Upload card */
.upload-card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 16px;
  padding: 28px;
  margin-bottom: 24px;
}
.upload-card-header { display: flex; align-items: center; gap: 14px; margin-bottom: 22px; }
.upload-icon-wrap {
  width: 48px; height: 48px; border-radius: 12px;
  background: var(--blue-dim);
  border: 1px solid rgba(59,127,255,.25);
  display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0;
}
.upload-card-title { font-size: 16px; font-weight: 700; color: var(--text); }
.upload-card-sub { font-size: 13px; color: var(--text2); margin-top: 2px; }

.dropzone {
  border: 1.5px dashed var(--border);
  border-radius: 12px;
  padding: 36px 24px;
  text-align: center;
  background: var(--surface2);
  transition: border-color .2s, background .2s;
  cursor: pointer;
  position: relative;
}
.dropzone:hover { border-color: var(--blue); background: rgba(59,127,255,.05); }
.dropzone-icon { font-size: 36px; margin-bottom: 10px; }
.dropzone-label { font-size: 14px; font-weight: 600; color: var(--text2); margin-bottom: 8px; }
.dropzone-hint { font-size: 12px; color: var(--text3); margin-bottom: 14px; }
.file-input {
  position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
}
#file-name-display {
  display: none; margin-top: 10px;
  background: rgba(59,127,255,.1); border: 1px solid rgba(59,127,255,.25);
  border-radius: 8px; padding: 8px 14px;
  font-size: 13px; color: var(--blue); font-weight: 600;
}
.btn-submit {
  margin-top: 18px;
  display: inline-flex; align-items: center; gap: 8px;
  background: var(--blue); color: #fff;
  border: none; border-radius: 9px;
  padding: 11px 24px; font-size: 14px; font-weight: 700;
  cursor: pointer; font-family: inherit;
  transition: background .15s, transform .15s;
}
.btn-submit:hover { background: #2B6FEF; transform: translateY(-1px); }
.err-msg { color: var(--red); font-size: 12px; margin-top: 8px; }

/* Alert */
.alert { padding: 12px 16px; border-radius: 9px; font-size: 14px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
.alert-success { background: rgba(34,197,94,.1); border: 1px solid rgba(34,197,94,.2); color: var(--green); }
.alert-error   { background: rgba(239,68,68,.1);  border: 1px solid rgba(239,68,68,.2);  color: var(--red); }

/* CV list card */
.list-card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 16px;
  padding: 24px;
}
.list-card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; }
.list-card-title { font-size: 15px; font-weight: 700; color: var(--text); }
.count-badge {
  background: var(--blue-dim); color: var(--blue);
  border: 1px solid rgba(59,127,255,.25);
  border-radius: 20px; padding: 3px 12px; font-size: 12px; font-weight: 700;
}

/* CV item */
.cv-item {
  display: flex; align-items: flex-start; gap: 14px;
  padding: 16px; border-radius: 12px;
  border: 1px solid var(--border);
  margin-bottom: 12px;
  background: var(--surface2);
  transition: border-color .15s;
}
.cv-item:last-child { margin-bottom: 0; }
.cv-item:hover { border-color: rgba(59,127,255,.35); }
.cv-file-icon {
  width: 44px; height: 44px; flex-shrink: 0; border-radius: 10px;
  background: rgba(239,68,68,.12); border: 1px solid rgba(239,68,68,.2);
  display: flex; align-items: center; justify-content: center; font-size: 20px;
}
.cv-meta { flex: 1; min-width: 0; }
.cv-name { font-size: 14px; font-weight: 700; color: var(--text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.cv-date { font-size: 12px; color: var(--text3); margin-top: 2px; margin-bottom: 8px; }
.cv-preview {
  font-size: 12px; color: var(--text2); line-height: 1.5;
  background: rgba(255,255,255,.03); border: 1px solid var(--border);
  border-radius: 8px; padding: 8px 12px;
  display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
}
.cv-actions { display: flex; gap: 8px; flex-shrink: 0; align-self: center; }
.btn-view {
  display: inline-flex; align-items: center; gap: 6px;
  background: var(--blue-dim); color: var(--blue);
  border: 1px solid rgba(59,127,255,.25);
  border-radius: 8px; padding: 7px 14px; font-size: 13px; font-weight: 600;
  text-decoration: none; transition: background .15s;
}
.btn-view:hover { background: rgba(59,127,255,.2); }
.btn-del {
  display: inline-flex; align-items: center;
  background: rgba(239,68,68,.1); color: var(--red);
  border: 1px solid rgba(239,68,68,.2);
  border-radius: 8px; padding: 7px 11px; font-size: 14px;
  cursor: pointer; font-family: inherit; transition: background .15s;
}
.btn-del:hover { background: rgba(239,68,68,.2); }

/* Empty state */
.empty-state { text-align: center; padding: 52px 24px; }
.empty-icon { font-size: 44px; margin-bottom: 12px; opacity: .5; }
.empty-title { font-size: 15px; font-weight: 700; color: var(--text2); margin-bottom: 4px; }
.empty-sub { font-size: 13px; color: var(--text3); }
</style>

<div class="page">

    {{-- Page header --}}
    <div class="page-header">
        <div class="page-title">Analyse de CV</div>
        <div class="page-sub">Téléchargez votre CV et recevez un rapport complet généré par l'IA</div>
    </div>

    {{-- Alerts --}}
    @if(session('error'))
        <div class="alert alert-error">✕ {{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif

    {{-- Upload card --}}
    <div class="upload-card">
        <div class="upload-card-header">
            <div class="upload-icon-wrap">🤖</div>
            <div>
                <div class="upload-card-title">Télécharger un nouveau CV</div>
                <div class="upload-card-sub">Formats acceptés : PDF uniquement · Taille max : 10 Mo</div>
            </div>
        </div>

        <form method="POST" action="{{ route('cv.upload') }}" enctype="multipart/form-data">
            @csrf
            <div class="dropzone" id="dropzone">
                <input type="file" name="cv" accept=".pdf" required class="file-input" id="cv-file"
                       onchange="showFileName(this)">
                <div class="dropzone-icon">📤</div>
                <div class="dropzone-label">Glissez votre CV ici ou cliquez pour sélectionner</div>
                <div class="dropzone-hint">PDF uniquement</div>
                <div id="file-name-display"></div>
            </div>
            @error('cv')
                <p class="err-msg">{{ $message }}</p>
            @enderror
            <button type="submit" class="btn-submit">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                Analyser avec l'IA
            </button>
        </form>
    </div>

    {{-- CV list --}}
    <div class="list-card">
        <div class="list-card-header">
            <div class="list-card-title">Mes CV analysés</div>
            <span class="count-badge">{{ $cvs->count() }} CV</span>
        </div>

        @forelse($cvs as $cv)
            <div class="cv-item">
                <div class="cv-file-icon">📄</div>
                <div class="cv-meta">
                    <div class="cv-name">{{ basename($cv->file_path) }}</div>
                    <div class="cv-date">Analysé {{ $cv->created_at->diffForHumans() }}</div>
                    <div class="cv-preview">{{ Str::limit(strip_tags($cv->analysis), 160) }}</div>
                </div>
                <div class="cv-actions">
                    <a href="{{ route('cv.show', $cv->id) }}" class="btn-view">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        Voir
                    </a>
                    <form method="POST" action="{{ route('cv.destroy', $cv->id) }}"
                          onsubmit="return confirm('Supprimer cette analyse ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-del">🗑️</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-icon">📄</div>
                <div class="empty-title">Aucun CV analysé</div>
                <div class="empty-sub">Téléchargez votre premier CV pour commencer</div>
            </div>
        @endforelse
    </div>

</div>

<script>
function showFileName(input) {
    const display = document.getElementById('file-name-display');
    if (input.files && input.files[0]) {
        display.style.display = 'block';
        display.textContent = '📎 ' + input.files[0].name;
    }
}
</script>
</x-app-layout>