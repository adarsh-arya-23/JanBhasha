<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $emailTitle ?? 'JanBhasha' }}</title>
    <style>
        /* ─── Reset ─────────────────────────────────────────── */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto,
                         'Helvetica Neue', Arial, sans-serif;
            background-color: #f0f4f8;
            color: #1a202c;
            -webkit-font-smoothing: antialiased;
        }
        a { color: #4f46e5; text-decoration: none; }

        /* ─── Outer wrapper ───────────────────────────────────── */
        .email-wrapper {
            width: 100%;
            background-color: #f0f4f8;
            padding: 40px 16px;
        }

        /* ─── Card ────────────────────────────────────────────── */
        .email-card {
            max-width: 580px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        }

        /* ─── Header ──────────────────────────────────────────── */
        .email-header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #2563eb 100%);
            padding: 40px 40px 32px;
            text-align: center;
        }
        .brand-logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }
        .brand-icon {
            width: 44px;
            height: 44px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }
        .brand-name {
            font-size: 24px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.5px;
        }
        .header-title {
            font-size: 20px;
            font-weight: 600;
            color: rgba(255,255,255,0.95);
            margin-top: 8px;
            line-height: 1.4;
        }

        /* ─── Body ────────────────────────────────────────────── */
        .email-body {
            padding: 40px;
        }
        .greeting {
            font-size: 22px;
            font-weight: 700;
            color: #1a202c;
            margin-bottom: 16px;
        }
        .body-text {
            font-size: 15px;
            line-height: 1.7;
            color: #4a5568;
            margin-bottom: 16px;
        }

        /* ─── Info box ────────────────────────────────────────── */
        .info-box {
            background: #f7f8ff;
            border: 1px solid #e0e7ff;
            border-left: 4px solid #4f46e5;
            border-radius: 10px;
            padding: 18px 20px;
            margin: 24px 0;
        }
        .info-box p {
            font-size: 14px;
            color: #374151;
            line-height: 1.6;
            margin-bottom: 6px;
        }
        .info-box p:last-child { margin-bottom: 0; }
        .info-label {
            font-weight: 600;
            color: #4f46e5;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ─── CTA Button ──────────────────────────────────────── */
        .cta-container {
            text-align: center;
            margin: 32px 0;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: #ffffff !important;
            font-size: 15px;
            font-weight: 600;
            padding: 14px 36px;
            border-radius: 50px;
            text-decoration: none;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 14px rgba(79, 70, 229, 0.35);
        }

        /* ─── Divider ─────────────────────────────────────────── */
        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 28px 0;
        }

        /* ─── Footer ──────────────────────────────────────────── */
        .email-footer {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 28px 40px;
            text-align: center;
        }
        .footer-text {
            font-size: 12px;
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 8px;
        }
        .footer-links {
            font-size: 12px;
        }
        .footer-links a {
            color: #94a3b8;
            margin: 0 8px;
        }
        .footer-links a:hover { color: #4f46e5; }
    </style>
</head>
<body>
<div class="email-wrapper">
    <div class="email-card">

        {{-- ─── Header ─────────────────────────────────────── --}}
        <div class="email-header">
            <div class="brand-logo">
                <div class="brand-icon">🌏</div>
                <span class="brand-name">JanBhasha</span>
            </div>
            <p class="header-title">{{ $headerTitle ?? '' }}</p>
        </div>

        {{-- ─── Body ───────────────────────────────────────── --}}
        <div class="email-body">
            @yield('content')
        </div>

        {{-- ─── Footer ─────────────────────────────────────── --}}
        <div class="email-footer">
            <p class="footer-text">
                You're receiving this email because you have an account on JanBhasha.<br>
                &copy; {{ date('Y') }} JanBhasha. All rights reserved.
            </p>
            <div class="footer-links">
                <a href="{{ config('app.url') }}">Visit Website</a>
                <a href="{{ config('app.url') . '/dashboard' }}">Dashboard</a>
            </div>
        </div>

    </div>
</div>
</body>
</html>
