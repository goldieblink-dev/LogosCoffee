<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terima Kasih - Logos Coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background: #f8f8f8;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        /* ── Animation ── */
        @keyframes pop-in {
            0% { transform: scale(0.5); opacity: 0; }
            70% { transform: scale(1.1); }
            100% { transform: scale(1); opacity: 1; }
        }
        .success-icon { animation: pop-in 0.5s ease forwards; }

        .success-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border: 1px solid #ebebeb;
            border-radius: 24px;
            padding: 2.5rem 2rem;
            box-shadow: 0 8px 40px rgba(0,0,0,0.06);
            text-align: center;
        }
        .check-circle {
            width: 68px; height: 68px;
            background: #111;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem;
        }
        .success-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #111;
            margin-bottom: 6px;
        }
        .success-sub {
            font-size: 0.82rem;
            color: #aaa;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        /* ── Receipt Box ── */
        .receipt-box {
            background: #f8f8f8;
            border-radius: 16px;
            padding: 1.25rem;
            text-align: left;
            margin-bottom: 1.75rem;
        }
        .receipt-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 0.5rem;
        }
        .receipt-label {
            font-size: 0.6rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #bbb;
            font-weight: 700;
        }
        .receipt-value {
            font-weight: 700;
            font-size: 0.9rem;
            color: #111;
        }
        .receipt-divider {
            height: 1px;
            background: #ebebeb;
            margin: 1rem 0;
        }
        .item-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.82rem;
            margin-bottom: 4px;
        }
        .item-name { color: #555; }
        .item-price { font-weight: 600; color: #111; }

        /* ── Back Button ── */
        .back-btn {
            display: inline-block;
            padding: 0.85rem 2rem;
            background: #111;
            color: #fff;
            border-radius: 14px;
            font-family: 'Inter', sans-serif;
            font-size: 0.88rem;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.2s;
            letter-spacing: 0.03em;
        }
        .back-btn:hover { background: #333; }
    </style>
</head>
<body>
    <div class="success-card">
        {{-- Check Icon --}}
        <div class="check-circle success-icon">
            <svg width="32" height="32" fill="none" stroke="#fff" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
            </svg>
        </div>

        <h1 class="success-title">Pembayaran Berhasil!</h1>
        <p class="success-sub">Pesanan Anda sedang diproses oleh kru kami.<br>Harap tunggu di meja Anda.</p>

        {{-- Receipt --}}
        <div class="receipt-box">
            <div class="receipt-row">
                <div>
                    <p class="receipt-label">Customer</p>
                    <p class="receipt-value">{{ $order->customer_name }}</p>
                </div>
                <div style="text-align:right;">
                    <p class="receipt-label">Nomor Meja</p>
                    <p class="receipt-value">{{ $order->table_number }}</p>
                </div>
            </div>

            <div class="receipt-divider"></div>

            <p class="receipt-label" style="margin-bottom:0.75rem;">Item Pesanan</p>
            @foreach($order->items as $item)
            <div class="item-row">
                <span class="item-name">{{ $item->quantity }}× {{ $item->product->name }}</span>
                <span class="item-price">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
            </div>
            @endforeach

            <div class="receipt-divider"></div>

            <div style="display:flex; justify-content:space-between; align-items:baseline;">
                <p class="receipt-label">Total Pembayaran</p>
                <p style="font-family:'Playfair Display',serif; font-size:1.1rem; font-weight:700; color:#111;">
                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                </p>
            </div>
        </div>

        <a href="{{ url('/') }}" class="back-btn">Kembali ke Beranda</a>
    </div>
</body>
</html>