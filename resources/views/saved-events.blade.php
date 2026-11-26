
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Event Tersimpan | BRAVE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div class="app-shell">
    <header class="topbar">
        <a class="brand" href="{{ route('saved-events') }}" aria-label="BRAVE Beranda">
            <span class="brand-mark">B</span>
            <span class="brand-word">BRAVE</span>
        </a>

        <div class="topbar-search">
            <span class="icon">⌕</span>
            <span>Cari event, komunitas, atau topik...</span>
            <kbd>⌘ K</kbd>
        </div>

        <div class="topbar-actions">
            <button class="icon-button notification" aria-label="Notifikasi">
                ♧<i></i>
            </button>
            <span class="topbar-divider"></span>
            <button class="profile-button">
                <span class="avatar">FA</span>
                <span class="profile-copy">
                    <b>Febri A.</b>
                    <small>Mahasiswa</small>
                </span>
                <span class="chevron">⌄</span>
            </button>
        </div>
    </header>

    <aside class="sidebar">
        <div class="sidebar-glow glow-one"></div>
        <div class="sidebar-glow glow-two"></div>

        <div class="sidebar-label">MENU UTAMA</div>
        <a class="side-link" href="#">
            <span class="side-icon">▦</span>Dashboard
        </a>
        <a class="side-link" href="#">
            <span class="side-icon">▣</span>Jelajahi Event
        </a>
        <a class="side-link" href="#">
            <span class="side-icon">◷</span>Event Saya
        </a>
        <a class="side-link active" href="{{ route('saved-events') }}">
            <span class="side-icon">♡</span>Event Tersimpan
        </a>

        <div class="sidebar-separator"></div>

        <div class="sidebar-label">LAINNYA</div>
        <a class="side-link" href="#">
            <span class="side-icon">⚙</span>Pengaturan
        </a>
        <a class="side-link" href="#">
            <span class="side-icon">ⓘ</span>Pusat Bantuan
        </a>

        <div class="sidebar-bottom">
            <div class="help-card">
                <div class="help-icon">✦</div>
                <b>Butuh bantuan?</b>
                <p>Temukan jawaban dan panduan penggunaan BRAVE.</p>
                <a href="#">Kunjungi Pusat Bantuan <span>↗</span></a>
            </div>
            <div class="sidebar-version">BRAVE v1.0.0</div>
        </div>
    </aside>

    <main class="main-content">
        <!-- DAFTAR EVENT TERSIMPAN -->
        <section id="listView" class="view">
            <div class="page-heading">
                <div>
                    <div class="eyebrow">RUANG PERSONAL</div>
                    <h1>Event Tersimpan</h1>
                    <p class="page-subtitle">
                        Kumpulan event menarik yang ingin kamu ikuti nanti.
                    </p>
                </div>
                <div class="heading-decoration">
                    <span>♡</span>
                </div>
            </div>

            <div class="toolbar">
                <label class="search-box">
                    <span class="icon">⌕</span>
                    <input
                        id="searchInput"
                        type="search"
                        placeholder="Cari event tersimpan..."
                    >
                    <span class="search-shortcut">/</span>
                </label>

                <select id="categoryFilter" class="filter-select">
                    <option value="all">Semua Kategori</option>
                    <option>Workshop</option>
                    <option>Kompetisi</option>
                    <option>Seminar</option>
                </select>

                <select id="sortFilter" class="filter-select">
                    <option value="newest">Terbaru disimpan</option>
                    <option value="oldest">Terlama disimpan</option>
                    <option value="date">Tanggal event</option>
                </select>

                <select id="formatFilter" class="filter-select">
                    <option value="all">Semua Format</option>
                    <option>Offline</option>
                    <option>Online</option>
                    <option>Hybrid</option>
                </select>

                <span class="saved-count" id="savedCount">
                    3 event tersimpan
                </span>
            </div>

            <div class="event-grid" id="eventGrid"></div>

            <div class="privacy-note">
                <span>♧</span>
                Hanya kamu yang dapat melihat daftar event dan catatan pribadimu.
            </div>
        </section>

        <!-- TAMPILAN KETIKA DAFTAR KOSONG -->
        <section id="emptyView" class="view empty-view hidden">
            <div class="page-heading">
                <div>
                    <div class="eyebrow">RUANG PERSONAL</div>
                    <h1>Event Tersimpan</h1>
                    <p class="page-subtitle">
                        Kumpulan event menarik yang ingin kamu ikuti nanti.
                    </p>
                </div>
            </div>

            <div class="empty-panel">
                <div class="empty-illustration">
                    <div class="empty-orbit orbit-a"></div>
                    <div class="empty-orbit orbit-b"></div>
                    <div class="empty-bookmark">♡</div>
                    <span class="spark spark-a">✦</span>
                    <span class="spark spark-b">✧</span>
                </div>

                <h2>Belum Ada Event Tersimpan</h2>
                <p>
                    Event yang kamu simpan akan muncul di sini.
                    Yuk, temukan event menarik dan simpan agar tidak terlewat!
                </p>

                <a class="btn btn-primary" href="#">
                    Jelajahi Event <span>→</span>
                </a>
            </div>
        </section>

        <!-- DETAIL EVENT -->
        <section id="detailView" class="view detail-view hidden">
            <a class="back-link" href="{{ route('saved-events') }}">
                ← <span>Kembali ke Event Tersimpan</span>
            </a>
            <div id="detailContent"></div>
        </section>

        <!-- EDIT CATATAN PRIBADI -->
        <section id="noteView" class="view note-view hidden">
            <a class="back-link" id="noteBack" href="{{ route('saved-events') }}">
                ← <span>Kembali ke Detail Event</span>
            </a>

            <div class="note-page-heading">
                <div class="eyebrow">RUANG PERSONAL</div>
                <h1>Catatan Pribadi</h1>
                <p class="page-subtitle">
                    Simpan hal penting agar persiapan event-mu lebih terorganisir.
                </p>
            </div>

            <div class="note-editor-card">
                <div class="note-card-heading">
                    <div>
                        <h2>Catatan untuk event</h2>
                        <p>Catatan ini hanya dapat dilihat olehmu.</p>
                    </div>
                    <span class="note-pencil">✎</span>
                </div>

                <div class="event-context" id="noteEventContext"></div>

                <label class="field-label" for="noteTextarea">
                    Catatan kamu
                </label>

                <textarea
                    id="noteTextarea"
                    maxlength="1000"
                    placeholder="Tulis hal yang perlu kamu ingat, persiapan yang harus dilakukan, atau informasi penting lainnya..."
                ></textarea>

                <div class="textarea-footer">
                    <span>
                        ♧ Catatan bersifat pribadi dan tidak dapat dilihat pengguna lain.
                    </span>
                    <span id="charCount">0/1000</span>
                </div>

                <div class="note-actions">
                    <button class="btn btn-secondary" id="cancelNote">Batal</button>
                    <button class="btn btn-primary" id="saveNote">
                        Simpan Catatan <span>→</span>
                    </button>
                </div>
            </div>
        </section>
    </main>

    <!-- NAVIGASI KHUSUS MOBILE -->
    <nav class="mobile-bottom-nav">
        <a href="#"><span>⌂</span>Beranda</a>
        <a href="#"><span>⌕</span>Jelajahi</a>
        <a href="#"><span>◷</span>Event Saya</a>
        <a class="selected" href="{{ route('saved-events') }}">
            <span>♡</span>Tersimpan
        </a>
        <a href="#"><span>☻</span>Profil</a>
    </nav>
</div>

<!-- MODAL KONFIRMASI HAPUS -->
<div
    class="modal-backdrop hidden"
    id="removeModal"
    role="dialog"
    aria-modal="true"
    aria-labelledby="removeTitle"
>
    <div class="modal-card remove-modal">
        <button class="modal-close" data-close-modal aria-label="Tutup">×</button>

        <div class="modal-symbol danger-symbol">!</div>

        <h2 id="removeTitle">Hapus dari Event Tersimpan?</h2>
        <p id="removeDescription">
            Event ini akan dihapus dari daftar event tersimpanmu.
        </p>

        <div class="modal-actions">
            <button class="btn btn-secondary" data-close-modal>Batal</button>
            <button class="btn btn-danger" id="confirmRemove">Ya, Hapus</button>
        </div>
    </div>
</div>

<div class="toast" id="toast"></div>

<script>
    window.savedEventsConfig = {
        baseUrl: @json(route('saved-events'))
    };
</script>
</body>
</html>
