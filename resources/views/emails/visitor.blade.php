<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notifikasi Tamu — SVMS</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background: #0f172a; color: #e2e8f0; }
        .container { max-width: 520px; margin: 40px auto; background: #1e293b; border-radius: 20px; overflow: hidden; border: 1px solid rgba(255,255,255,0.06); }
        .header { background: linear-gradient(135deg, #7c3aed, #6d28d9); padding: 32px 24px; text-align: center; }
        .header h1 { margin: 0; font-size: 22px; font-weight: 800; color: #fff; }
        .header p { margin: 8px 0 0; font-size: 13px; color: rgba(255,255,255,0.7); }
        .body { padding: 32px 24px; }
        .badge { display: inline-block; background: rgba(234,179,8,0.15); color: #facc15; border: 1px solid rgba(234,179,8,0.3); font-size: 11px; font-weight: 700; padding: 4px 12px; border-radius: 999px; text-transform: uppercase; letter-spacing: 1px; }
        .info-card { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06); border-radius: 12px; padding: 20px; margin: 20px 0; }
        .info-row { display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px solid rgba(255,255,255,0.04); }
        .info-row:last-child { border-bottom: none; }
        .info-label { font-size: 12px; color: #64748b; }
        .info-value { font-size: 13px; font-weight: 600; color: #e2e8f0; }
        .cta { display: block; text-align: center; background: linear-gradient(135deg, #7c3aed, #6d28d9); color: #fff; font-size: 14px; font-weight: 700; padding: 14px 24px; border-radius: 12px; text-decoration: none; margin: 24px 0 8px; }
        .cta:hover { opacity: 0.9; }
        .footer { text-align: center; padding: 20px 24px; font-size: 11px; color: #475569; }
    </style>
</head>
<body>
    <div class="container">
        {{-- HEADER --}}
        <div class="header">
            <h1>🔔 Ada Tamu Menunggu</h1>
            <p>{{ now()->translatedFormat('d F Y, H:i') }} WIB</p>
        </div>

        {{-- BODY --}}
        <div class="body">
            <div style="text-align: center; margin-bottom: 16px;">
                <span class="badge">⏳ Menunggu Konfirmasi</span>
            </div>

            <p style="font-size: 14px; line-height: 1.6; margin-bottom: 0;">
                Halo! Ada tamu yang ingin bertemu dengan Anda. Berikut detail kunjungan:
            </p>

            <div class="info-card">
                <div class="info-row">
                    <span class="info-label">Nama Tamu</span>
                    <span class="info-value">{{ $visitor->name }}</span>
                </div>
                @if($visitor->institution)
                <div class="info-row">
                    <span class="info-label">Instansi</span>
                    <span class="info-value">{{ $visitor->institution }}</span>
                </div>
                @endif
                @if($visitor->phone)
                <div class="info-row">
                    <span class="info-label">No. HP</span>
                    <span class="info-value">{{ $visitor->phone }}</span>
                </div>
                @endif
                @if($visitor->purpose)
                <div class="info-row">
                    <span class="info-label">Keperluan</span>
                    <span class="info-value">{{ $visitor->purpose }}</span>
                </div>
                @endif
                <div class="info-row">
                    <span class="info-label">Check-in</span>
                    <span class="info-value">{{ $visitor->checkin_time?->format('H:i') ?? '-' }}</span>
                </div>
            </div>

            <a href="{{ url('/staff') }}" class="cta">
                Buka Dashboard Staff →
            </a>

            <p style="font-size: 12px; color: #64748b; text-align: center; margin-top: 12px;">
                Silakan <strong>terima</strong> atau <strong>tolak</strong> kunjungan di dashboard Anda.
            </p>
        </div>

        {{-- FOOTER --}}
        <div class="footer">
            <p>Email ini dikirim otomatis oleh SVMS (School Visitor Management System).</p>
        </div>
    </div>
</body>
</html>
