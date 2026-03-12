<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Self Order - Logos Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
        }

        /* ══ SPLIT LAYOUT ══ */
        .split-left {
            flex: 2;
            order: 1;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: flex-end;
            padding: 3rem;
            min-height: 280px;
        }
        .split-right {
            flex: 1;
            order: 2;
            min-width: 360px;
            max-width: 460px;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 2.5rem;
            overflow-y: auto;
        }

        /* ── Left Panel Background ── */
        .left-bg {
            position: absolute;
            inset: 0;
            background-image: url('https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=1200&q=80');
            background-size: cover;
            background-position: center;
            transform: scale(1.03);
            transition: transform 8s ease;
        }
        .split-left:hover .left-bg { transform: scale(1); }
        .left-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(160deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.75) 100%);
        }
        .left-content {
            position: relative;
            z-index: 10;
            color: #fff;
        }
        .left-eyebrow {
            font-size: 0.65rem;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.55);
            font-weight: 600;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .left-eyebrow::before {
            content: '';
            display: inline-block;
            width: 24px;
            height: 1px;
            background: rgba(255,255,255,0.4);
        }
        .left-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3.5rem);
            font-weight: 700;
            line-height: 1.15;
            margin-bottom: 1rem;
        }
        .left-title em { font-style: italic; }
        .left-tagline {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.5);
            letter-spacing: 0.1em;
        }

        /* ── Right Panel ── */
        .right-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 3rem;
            text-decoration: none;
        }
        .logo-circle {
            width: 36px; height: 36px;
            background: #111;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .logo-circle span {
            font-family: 'Playfair Display', serif;
            font-size: 0.85rem;
            color: #fff;
            font-weight: 700;
            font-style: italic;
        }
        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #111;
        }

        .form-heading {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.6rem, 3vw, 2.2rem);
            font-weight: 700;
            color: #111;
            margin-bottom: 0.4rem;
            line-height: 1.2;
        }
        .form-subheading {
            font-size: 0.82rem;
            color: #aaa;
            margin-bottom: 2.5rem;
        }

        /* ── Form Elements ── */
        .form-group { margin-bottom: 1.25rem; }
        .form-label {
            display: block;
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #999;
            margin-bottom: 7px;
        }
        .form-input {
            width: 100%;
            padding: 0.9rem 1rem;
            background: #fafafa;
            border: 1px solid #e8e8e8;
            border-radius: 10px;
            font-size: 0.95rem;
            font-family: 'Inter', sans-serif;
            color: #111;
            font-weight: 500;
            transition: border-color 0.2s, background 0.2s;
            outline: none;
        }
        .form-input:focus {
            border-color: #111;
            background: #fff;
        }
        .form-input::placeholder { color: #ccc; font-weight: 400; }

        .submit-btn {
            width: 100%;
            padding: 1rem 1.5rem;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            cursor: pointer;
            transition: background 0.2s, transform 0.15s;
            margin-top: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .submit-btn:hover { background: #2a2a2a; }
        .submit-btn:active { transform: scale(0.98); }

        .form-footer {
            margin-top: 2rem;
            font-size: 0.72rem;
            color: #ccc;
            text-align: center;
        }
        .form-footer a {
            color: #999;
            text-decoration: none;
            font-weight: 600;
        }
        .form-footer a:hover { color: #111; }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            body { flex-direction: column; }
            .split-left {
                min-height: 260px;
                padding: 2rem;
                align-items: flex-end;
            }
            .left-title { font-size: 2rem; }
            .split-right {
                max-width: 100%;
                padding: 2.5rem 1.5rem;
            }
        }
    </style>
</head>
<body>

    {{-- ══ RIGHT PANEL (form) ══ --}}
    <div class="split-right">
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="right-logo">
            <div class="logo-circle"><span>LC</span></div>
            <span class="logo-text">Logos Coffee</span>
        </a>

        {{-- Heading --}}
        <h2 class="form-heading">Mulai Pesanan<br>Anda</h2>
        <p class="form-subheading">Isi data di bawah untuk melanjutkan ke menu</p>

        {{-- Form --}}
        <form action="{{ route('self-order.info.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label" for="table_number">Nomor Meja</label>
                <input
                    class="form-input"
                    type="number"
                    name="table_number"
                    id="table_number"
                    value="{{ old('table_number', $table) }}"
                    required
                    placeholder="Contoh: 05"
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="customer_name">Nama Lengkap</label>
                <input
                    class="form-input"
                    type="text"
                    name="customer_name"
                    id="customer_name"
                    required
                    placeholder="Nama Anda"
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="customer_phone">
                    No. HP &nbsp;<span style="color:#ddd; font-weight:400; letter-spacing:normal; text-transform:none;">Opsional</span>
                </label>
                <input
                    class="form-input"
                    type="tel"
                    name="customer_phone"
                    id="customer_phone"
                    placeholder="08xxxxxx"
                >
            </div>

            <button type="submit" class="submit-btn">
                Lanjut ke Menu
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </button>
        </form>

        <p class="form-footer">
            Dengan memesan, Anda menyetujui <a href="#">syarat & ketentuan</a> kami.
        </p>
    </div>

    {{-- ══ LEFT PANEL (image) ══ --}}
    <div class="split-left">
        <div class="left-bg"></div>
        <div class="left-overlay"></div>
        <div class="left-content">
            <p class="left-eyebrow">Est. 2024</p>
            <h1 class="left-title">
                Welcome to<br>
                <em>Logos Coffee</em>
            </h1>
            <p class="left-tagline">Brewing Excellence, One Cup at a Time</p>
        </div>
    </div>

</body>
</html>