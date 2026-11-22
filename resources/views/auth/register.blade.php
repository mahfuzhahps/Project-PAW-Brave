<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Daftar Akun - BRAVE</title>

    <link rel="stylesheet" href="{{ asset('assets/css/globals.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styleguide.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/register-state.css') }}">

    <script src="{{ asset('assets/js/auth.js') }}" defer></script>
</head>

<body>

<main class="br-register-page">

    <section class="br-left-panel">

        <img
            class="br-background"
            src="https://c.animaapp.com/4cDVr1hh/img/background-ambient-geometric-svg-graphic-elements---svg.svg"
            alt=""
            aria-hidden="true"
        >

        <div class="br-left-inner">

            <header class="br-brand-hero">
                <div class="br-brand-lockup">
                    <div class="br-brand-topline">
                        <img
                            src="{{ asset('assets/images/BRAVE symbol.svg') }}"
                            alt=""
                            class="br-brand-logo"
                        >

                        <span class="br-brand-name">BRAVE</span>

                        <span class="br-brand-university">
                            UNIVERSITAS BRAWIJAYA
                        </span>
                    </div>

                    <p class="br-brand-tagline">
                        Brawijaya Event Discovery Hub
                    </p>
                </div>

                <div class="br-hero-content">
                    <h1 class="br-hero-title">
                        Mulai Perjalanan Event-mu di<br>
                        BRAVE!
                    </h1>

                    <p class="br-hero-description">
                        Temukan dan ikuti berbagai event menarik, kompetisi, seminar, dan
                        <br class="br-desktop-break">
                        workshop resmi di lingkungan Universitas Brawijaya.
                    </p>
                </div>
            </header>

            <section class="br-pass-card">
                <div class="br-pass-card-header">
                    <div class="br-pass-icon">
                        <img
                            src="{{ asset('assets/icons/ticket.svg') }}"
                            alt=""
                            aria-hidden="true"
                        >
                    </div>

                    <div class="br-pass-heading">
                        <p class="br-pass-eyebrow">PASS MAHASISWA</p>
                        <h2 class="br-pass-title">Brawijaya Event Access</h2>
                    </div>
                </div>

                <div class="br-pass-divider"></div>

                <div class="br-pass-stats">
                    <div class="br-stat-card">
                        <p class="br-stat-number">500+</p>
                        <p class="br-stat-label">Event Kampus Aktif</p>
                    </div>

                    <div class="br-stat-card">
                        <p class="br-stat-number">18</p>
                        <p class="br-stat-label">Fakultas &amp; Vokasi UB</p>
                    </div>
                </div>
            </section>

            <footer class="br-left-footer">
                <img
                    src="{{ asset('assets/icons/shield-check.svg') }}"
                    alt=""
                    aria-hidden="true"
                >

                <p>
                    Brawijaya Event Ecosystem •
                    Satu Akun untuk Semua Aktivitas Kampus
                </p>
            </footer>

        </div>
    </section>

    <section class="br-right-panel">

        <nav class="br-top-navigation" aria-label="Navigasi bantuan">
            <a href="{{ url('/') }}" class="br-top-link">
                <img
                    src="{{ asset('assets/icons/move-left.svg') }}"
                    alt=""
                    aria-hidden="true"
                >
                <span>Kembali ke Beranda</span>
            </a>

            <span class="br-top-link br-help-link">
                <img
                    src="{{ asset('assets/icons/circle-question-mark.svg') }}"
                    alt=""
                    aria-hidden="true"
                >
                <span>Butuh Bantuan?</span>
            </span>
        </nav>

        <div class="br-right-main">
            <div class="br-auth-content">

                <div
                    class="br-system-notification"
                    id="register-system-error"
                    role="alert"
                    aria-live="assertive"
                    hidden
                >
                    <p id="register-system-error-message">
                        Pendaftaran belum berhasil. Terjadi gangguan pada sistem. Silakan coba lagi.
                    </p>
                </div>

                <header class="br-form-header">
                    <h2>Buat Akun BRAVE</h2>
                    <p>
                        Daftar untuk mulai menjelajahi berbagai event
                        di Universitas Brawijaya.
                    </p>
                </header>

                <form
                    method="POST"
                    action="{{ route('register.store') }}"
                    class="br-register-form"
                    id="register-form"
                    novalidate
                >
                    @csrf

                    <div class="br-form-fields">

                        <div class="br-field">
                            <label for="name" class="br-field-label">
                                Nama Lengkap <span>*</span>
                            </label>

                            <div class="br-input-wrap">
                                <span class="br-input-icon">
                                    <img
                                        src="{{ asset('assets/icons/user.svg') }}"
                                        alt=""
                                        aria-hidden="true"
                                    >
                                </span>

                                <input
                                    class="br-input"
                                    type="text"
                                    name="name"
                                    id="name"
                                    placeholder="Masukkan nama lengkap"
                                    value="{{ old('name') }}"
                                    autocomplete="name"
                                    maxlength="255"
                                    required
                                    aria-describedby="name-error"
                                    @if ($errors->has('name')) aria-invalid="true" @endif
                                >
                            </div>

                            <p
                                class="br-field-error"
                                id="name-error"
                                role="alert"
                                @if (!$errors->has('name')) hidden @endif
                            >@if ($errors->has('name')){{ $errors->first('name') }}@endif</p>
                        </div>

                        <div class="br-field">
                            <label for="email" class="br-field-label">
                                Email <span>*</span>
                            </label>

                            <div class="br-input-wrap">
                                <span class="br-input-icon">
                                    <img
                                        src="{{ asset('assets/icons/mail.svg') }}"
                                        alt=""
                                        aria-hidden="true"
                                    >
                                </span>

                                <input
                                    class="br-input"
                                    type="email"
                                    name="email"
                                    id="email"
                                    placeholder="Masukkan alamat email"
                                    value="{{ old('email') }}"
                                    autocomplete="email"
                                    maxlength="255"
                                    required
                                    aria-describedby="email-error email-hint"
                                    @if ($errors->has('email')) aria-invalid="true" @endif
                                >
                            </div>

                            <p
                                class="br-field-error"
                                id="email-error"
                                role="alert"
                                @if (!$errors->has('email')) hidden @endif
                            >@if ($errors->has('email')){{ $errors->first('email') }}@endif</p>

                            <div class="br-email-hint" id="email-hint">
                                <img
                                    src="{{ asset('assets/icons/info.svg') }}"
                                    alt=""
                                    aria-hidden="true"
                                >
                                <span>
                                    Gunakan email aktif (disarankan @student.ub.ac.id)
                                </span>
                            </div>
                        </div>

                        <div class="br-field">
                            <label for="password" class="br-field-label">
                                Password <span>*</span>
                            </label>

                            <div class="br-input-wrap">
                                <span class="br-input-icon">
                                    <img
                                        src="{{ asset('assets/icons/lock.svg') }}"
                                        alt=""
                                        aria-hidden="true"
                                    >
                                </span>

                                <input
                                    class="br-input br-password-input"
                                    type="password"
                                    name="password"
                                    id="password"
                                    placeholder="Masukkan password"
                                    autocomplete="new-password"
                                    required
                                    aria-describedby="password-error password-hint"
                                    @if ($errors->has('password')) aria-invalid="true" @endif
                                >

                                <button
                                    type="button"
                                    class="br-password-toggle"
                                    data-toggle-password
                                    data-target="password"
                                    aria-label="Tampilkan password"
                                    aria-pressed="false"
                                >
                                    <img
                                        src="{{ asset('assets/icons/eye.svg') }}"
                                        data-eye-icon
                                        data-eye-visible="{{ asset('assets/icons/eye.svg') }}"
                                        data-eye-hidden="{{ asset('assets/icons/eye-off.svg') }}"
                                        alt=""
                                        aria-hidden="true"
                                    >
                                </button>
                            </div>

                            <p
                                class="br-field-error"
                                id="password-error"
                                role="alert"
                                @if (!$errors->has('password')) hidden @endif
                            >@if ($errors->has('password')){{ $errors->first('password') }}@endif</p>

                            <div
                                class="br-strength-row"
                                data-strength-meter
                                data-level="0"
                            >
                                <div class="br-strength-bars">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>

                                <p class="br-strength-text" id="password-hint">
                                    Minimal 8 karakter, wajib mengandung huruf dan angka.
                                </p>
                            </div>
                        </div>

                        <div class="br-field">
                            <label for="password_confirmation" class="br-field-label">
                                Konfirmasi Password <span>*</span>
                            </label>

                            <div class="br-input-wrap">
                                <span class="br-input-icon">
                                    <img
                                        src="{{ asset('assets/icons/lock.svg') }}"
                                        alt=""
                                        aria-hidden="true"
                                    >
                                </span>

                                <input
                                    class="br-input br-password-input"
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    placeholder="Masukkan ulang password"
                                    autocomplete="new-password"
                                    required
                                    aria-describedby="confirmation-error"
                                    @if ($errors->has('password_confirmation')) aria-invalid="true" @endif
                                >

                                <button
                                    type="button"
                                    class="br-password-toggle"
                                    data-toggle-password
                                    data-target="password_confirmation"
                                    aria-label="Tampilkan konfirmasi password"
                                    aria-pressed="false"
                                >
                                    <img
                                        src="{{ asset('assets/icons/eye.svg') }}"
                                        data-eye-icon
                                        data-eye-visible="{{ asset('assets/icons/eye.svg') }}"
                                        data-eye-hidden="{{ asset('assets/icons/eye-off.svg') }}"
                                        alt=""
                                        aria-hidden="true"
                                    >
                                </button>
                            </div>

                            <p
                                class="br-field-error"
                                id="confirmation-error"
                                role="alert"
                                @if (!$errors->has('password_confirmation')) hidden @endif
                            >@if ($errors->has('password_confirmation')){{ $errors->first('password_confirmation') }}@endif</p>
                        </div>

                        <button
                            type="submit"
                            class="br-submit-button"
                            id="register-submit-button"
                            data-submit-button
                        >
                            <span
                                class="br-loading-spinner"
                                data-submit-spinner
                                aria-hidden="true"
                                hidden
                            ></span>

                            <span data-submit-label>Daftar</span>

                            <img
                                src="{{ asset('assets/icons/arrow-right.svg') }}"
                                alt=""
                                aria-hidden="true"
                                data-submit-arrow
                            >
                        </button>

                        <p
                            class="br-processing-message"
                            data-processing-message
                            role="status"
                            aria-live="polite"
                            hidden
                        >
                            Sedang membuat akun Anda, mohon tunggu sebentar.
                        </p>

                        <div class="br-login-link">
                            <span>Sudah punya akun?</span>
                            <a href="{{ url('/login') }}" class="br-login-text">
                                Masuk
                            </a>
                        </div>

                    </div>
                </form>

            </div>
        </div>

        <footer class="br-right-footer">
            <p class="br-legal-text">
                <span>Dengan mendaftar, Anda menyetujui </span>
                <span class="br-legal-link">Syarat &amp; Ketentuan</span>
                <span> serta </span>
                <span class="br-legal-link">Kebijakan Privasi</span>
                <span> BRAVE.</span>
            </p>

            <p class="br-copyright">
                © 2026 Universitas Brawijaya •
                Pusat Layanan Acara Kampus
            </p>
        </footer>

    </section>

</main>

<div
    class="br-modal-overlay"
    id="register-success-modal"
    role="presentation"
    hidden
>
    <section
        class="br-success-modal"
        role="dialog"
        aria-modal="true"
        aria-labelledby="register-success-title"
        aria-describedby="register-success-description"
    >
        <div class="br-success-icon-background" aria-hidden="true">
            <svg viewBox="0 0 32 32" role="img" aria-label="">
                <path
                    d="M7.5 16.5L13.2 22L24.5 10.5"
                    fill="none"
                    stroke="#16794B"
                    stroke-width="2.6"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </div>

        <h2 id="register-success-title">Registrasi berhasil!</h2>

        <p id="register-success-description">
            Akun BRAVE kamu berhasil dibuat.<br>
            Silakan mulai menjelajahi event.
        </p>

        <a
            href="{{ url('/') }}"
            class="br-success-modal-button"
            id="register-success-continue"
        >
            <span>Masuk ke BRAVE</span>
            <img
                src="{{ asset('assets/icons/arrow-right.svg') }}"
                alt=""
                aria-hidden="true"
            >
        </a>
    </section>
</div>

</body>
</html>
