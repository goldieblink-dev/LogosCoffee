<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran - Logos Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: #fafafa;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        /* ══ HEADER ══ */
        .site-header {
            background: #111;
            padding: 0.9rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .header-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #fff;
        }

        /* ══ CONTENT ══ */
        .page-wrap {
            max-width: 480px;
            margin: 0 auto;
            padding: 2rem 1.25rem 3rem;
        }

        /* ── Step indicator ── */
        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-bottom: 2rem;
        }
        .step-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #ddd;
        }
        .step-dot.active {
            background: #111;
            width: 24px;
            border-radius: 4px;
        }

        /* ── Page heading ── */
        .page-heading {
            text-align: center;
            margin-bottom: 2rem;
        }
        .page-eyebrow {
            font-size: 0.62rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: #aaa;
            font-weight: 700;
            margin-bottom: 6px;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            color: #111;
        }
        .page-sub {
            font-size: 0.82rem;
            color: #999;
            margin-top: 6px;
        }

        /* ── QRIS Card ── */
        .qris-card {
            background: #fff;
            border: 1px solid #ebebeb;
            border-radius: 20px;
            padding: 1.75rem;
            text-align: center;
            margin-bottom: 1.25rem;
        }
        .qris-frame {
            display: inline-block;
            border: 2px dashed #e0e0e0;
            border-radius: 16px;
            padding: 1rem;
            background: #fafafa;
            margin-bottom: 1rem;
        }
        .qris-frame img {
            width: 180px; height: 180px;
            display: block;
            border-radius: 8px;
        }
        .qris-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #111;
            color: #fff;
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.1em;
        }
        .qris-badge svg { opacity: 0.7; }

        /* ── Order Info Card ── */
        .info-card {
            background: #fff;
            border: 1px solid #ebebeb;
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 1.25rem;
        }
        .info-card-label {
            font-size: 0.62rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #bbb;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.6rem 0;
            border-bottom: 1px solid #f5f5f5;
            font-size: 0.875rem;
        }
        .info-row:last-child { border-bottom: none; }
        .info-row-label { color: #999; }
        .info-row-value { font-weight: 700; color: #111; }

        /* ── Total ── */
        .total-strip {
            background: #111;
            border-radius: 16px;
            padding: 1.1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.25rem;
        }
        .total-label {
            font-size: 0.78rem;
            color: rgba(255,255,255,0.5);
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .total-amount {
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-weight: 700;
            color: #fff;
        }

        /* ── Button ── */
        .pay-btn {
            width: 100%;
            padding: 1rem;
            background: #fff;
            color: #111;
            border: 2px solid #111;
            border-radius: 14px;
            font-family: 'Inter', sans-serif;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s, color 0.2s;
        }
        .pay-btn:hover {
            background: #111;
            color: #fff;
        }
        .pay-note {
            font-size: 0.72rem;
            color: #ccc;
            text-align: center;
            margin-top: 1rem;
            line-height: 1.6;
        }
    </style>
</head>
<body>

    {{-- ══ HEADER ══ --}}
    <header class="site-header">
        <span class="header-brand">Logos Coffee</span>
    </header>

    <div class="page-wrap">

        {{-- Step indicator --}}
        <div class="step-indicator">
            <div class="step-dot"></div>
            <div class="step-dot"></div>
            <div class="step-dot active"></div>
        </div>

        {{-- Heading --}}
        <div class="page-heading">
            <p class="page-eyebrow">Langkah Terakhir</p>
            <h1 class="page-title">Selesaikan Pembayaran</h1>
            <p class="page-sub">Scan QRIS di bawah ini untuk membayar</p>
        </div>

        {{-- QRIS --}}
        <div class="qris-card">
            <div class="qris-frame">
                <img
                    src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=LOGOSCOFFEE-ORDER-{{ $order->id }}"
                    alt="QRIS Logos Coffee"
                >
            </div>
            <div class="qris-badge">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11V7m0 4v4m0 0h4m-4 0H8m0-9a4 4 0 118 0v2H8V7z"/>
                </svg>
                QRIS &nbsp;·&nbsp; Logos Coffee
            </div>
        </div>

        {{-- Order Info --}}
        <div class="info-card">
            <p class="info-card-label">Ringkasan Order</p>
            <div class="info-row">
                <span class="info-row-label">Order ID</span>
                <span class="info-row-value" style="font-family:monospace; font-size:0.82rem;">#LOGOS-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="info-row">
                <span class="info-row-label">Nomor Meja</span>
                <span class="info-row-value">{{ $order->table_number }}</span>
            </div>
            <div class="info-row">
                <span class="info-row-label">Nama</span>
                <span class="info-row-value">{{ $order->customer_name }}</span>
            </div>
        </div>

        {{-- Total --}}
        <div class="total-strip">
            <span class="total-label">Total</span>
            <span class="total-amount">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
        </div>

        {{-- Confirm --}}
        <form action="{{ route('self-order.payment.process', $order) }}" method="POST">
            @csrf
            <button type="submit" class="pay-btn">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
                Saya Sudah Bayar
            </button>
        </form>

        <p class="pay-note">Sistem akan memverifikasi pembayaran Anda secara otomatis.<br>Jangan tinggalkan halaman ini sebelum konfirmasi.</p>

    </div>

</body>
</html>