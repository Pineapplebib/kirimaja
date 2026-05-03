<!DOCTYPE html>
<html lang="id" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="format-detection" content="telephone=no,address=no,email=no,date=no,url=no">
    <title>Verifikasi Email - KirimAja</title>

    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* ── BLUE LINKS ── */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        u+#body a {
            color: inherit;
            text-decoration: none;
            font-size: inherit;
            font-family: inherit;
            font-weight: inherit;
            line-height: inherit;
        }

        #MessageViewBody a {
            color: inherit;
            text-decoration: none;
            font-size: inherit;
            font-family: inherit;
            font-weight: inherit;
            line-height: inherit;
        }

        /* ── RESPONSIVE ── */
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
            }

            .fluid {
                max-width: 100% !important;
                height: auto !important;
            }

            .stack-column {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }

            .center-on-mobile {
                text-align: center !important;
            }

            .container-padding {
                padding-left: 20px !important;
                padding-right: 20px !important;
            }

            .btn-full {
                width: 100% !important;
            }
        }
    </style>
</head>

<body id="body" style="margin:0; padding:0; background-color:#f1f5f9; font-family:'Segoe UI', Arial, sans-serif;">

    <!-- Preview text (hidden) -->
    <div style="display:none; max-height:0; overflow:hidden; mso-hide:all;">
        Verifikasi alamat email Anda untuk mulai menggunakan KirimAja
        &#8203;&zwnj;&nbsp;&#8203;&zwnj;&nbsp;&#8203;&zwnj;&nbsp;&#8203;&zwnj;&nbsp;&#8203;&zwnj;&nbsp;&#8203;&zwnj;&nbsp;&#8203;&zwnj;&nbsp;&#8203;&zwnj;&nbsp;&#8203;&zwnj;&nbsp;&#8203;&zwnj;&nbsp;&#8203;&zwnj;
    </div>

    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
        style="background-color:#f1f5f9;">
        <tr>
            <td align="center" style="padding: 32px 16px;">

                <!-- ════════ EMAIL CONTAINER ════════ -->
                <table role="presentation" class="email-container" cellspacing="0" cellpadding="0" border="0"
                    width="560" style="max-width:560px;">

                    <!-- ── HEADER ── -->
                    <tr>
                        <td align="center" style="background-color:#1B3A6B; padding:28px 40px; border-radius:12px 12px 0 0;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td valign="middle" align="center">
                                        <span style="font-size:22px; font-weight:700; color:#ffffff; vertical-align:middle; letter-spacing:-0.3px;">KirimAja</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-top:4px;">
                                        <span style="font-size:11px; color:rgba(255,255,255,0.8);">Solusi Pengiriman Terpercaya</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- ── HERO SECTION ── -->
                    <tr>
                        <td align="center" style="background-color:#0F2347; padding:24px 40px 32px;">
                            <!-- Icon -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                style="margin: 0 auto 16px;">
                                <tr>
                                    <td align="center"
                                        style="width:64px; height:64px; background-color:rgba(255,255,255,0.1); border-radius:50%; font-size:28px; line-height:64px;">
                                        ✉️
                                    </td>
                                </tr>
                            </table>
                            <h1
                                style="margin:0 0 8px; font-size:22px; font-weight:700; color:#ffffff; line-height:1.3;">
                                Verifikasi Email Anda
                            </h1>
                            <p
                                style="margin:0; font-size:14px; color:rgba(255,255,255,0.85); line-height:1.6; max-width:380px;">
                                Halo, <strong style="color:#fff;">{{ $user->name ?? 'Pengguna' }}</strong>! Terima kasih
                                telah mendaftar di KirimAja. Klik tombol di bawah untuk memverifikasi email Anda.
                            </p>
                        </td>
                    </tr>

                    <!-- ── BODY CARD ── -->
                    <tr>
                        <td
                            style="background-color:#ffffff; padding:36px 40px; border-left:1px solid #e2e8f0; border-right:1px solid #e2e8f0;">

                            <!-- Step indicator -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
                                style="margin-bottom:28px;">
                                <tr>
                                    <td align="center">
                                        <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                            <tr>
                                                <!-- Step 1 -->
                                                <td align="center" width="80">
                                                    <div
                                                        style="width:32px; height:32px; background:#1B3A6B; border-radius:50%; margin:0 auto 4px; text-align:center; line-height:32px; font-size:13px; font-weight:700; color:#fff;">
                                                        1</div>
                                                    <div style="font-size:10px; color:#64748b;">Daftar</div>
                                                </td>
                                                <!-- Arrow -->
                                                <td width="40"
                                                    style="padding:0 4px; color:#cbd5e1; font-size:18px; padding-bottom:16px;">
                                                    ›</td>
                                                <!-- Step 2 -->
                                                <td align="center" width="80">
                                                    <div
                                                        style="width:32px; height:32px; background:#1B3A6B; border-radius:50%; margin:0 auto 4px; text-align:center; line-height:32px; font-size:13px; font-weight:700; color:#fff; box-shadow:0 0 0 4px #EBF2FF;">
                                                        2</div>
                                                    <div style="font-size:10px; color:#1B3A6B; font-weight:600;">
                                                        Verifikasi</div>
                                                </td>
                                                <!-- Arrow -->
                                                <td width="40"
                                                    style="padding:0 4px; color:#cbd5e1; font-size:18px; padding-bottom:16px;">
                                                    ›</td>
                                                <!-- Step 3 -->
                                                <td align="center" width="80">
                                                    <div
                                                        style="width:32px; height:32px; background:#f1f5f9; border-radius:50%; margin:0 auto 4px; text-align:center; line-height:32px; font-size:13px; font-weight:700; color:#94a3b8; border:2px solid #e2e8f0;">
                                                        3</div>
                                                    <div style="font-size:10px; color:#94a3b8;">Mulai Kirim</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Divider -->
                            <div style="border-top:1px solid #f1f5f9; margin-bottom:28px;"></div>

                            <!-- Main text -->
                            <p style="margin:0 0 12px; font-size:15px; color:#374151; line-height:1.7;">
                                Anda baru saja mendaftarkan akun KirimAja menggunakan alamat email:
                            </p>
                            <div
                                style="background:#EBF2FF; border:1px solid #bfdbfe; border-radius:8px; padding:12px 16px; margin-bottom:24px; text-align:center;">
                                <span
                                    style="font-size:15px; font-weight:600; color:#1B3A6B;">{{ $user->email ?? 'nama@email.com' }}</span>
                            </div>

                            <!-- CTA Button -->
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
                                style="margin-bottom:24px;">
                                <tr>
                                    <td align="center">
                                        <!--[if mso]>
                                        <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ $verificationUrl ?? '#' }}" style="height:48px;v-text-anchor:middle;width:260px;" arcsize="16%" stroke="f" fillcolor="#F47B20">
                                            <w:anchorlock/>
                                            <center style="color:#ffffff;font-family:sans-serif;font-size:15px;font-weight:bold;">Verifikasi Email Saya</center>
                                        </v:roundrect>
                                        <![endif]-->
                                        <!--[if !mso]><!-->
                                        <a href="{{ $verificationUrl ?? '#' }}"
                                            style="display:inline-block; padding:14px 40px; background-color:#F47B20; color:#ffffff; font-size:15px; font-weight:700; text-decoration:none; border-radius:8px; letter-spacing:0.3px;">
                                            &#10003;&nbsp; Verifikasi Email Saya
                                        </a>
                                        <!--<![endif]-->
                                    </td>
                                </tr>
                            </table>

                            <!-- Expiry notice -->
                            <div
                                style="background:#fef9c3; border:1px solid #fde68a; border-radius:8px; padding:12px 16px; margin-bottom:24px;">
                                <p style="margin:0; font-size:12px; color:#92400e; line-height:1.6;">
                                    <strong>⏰ Perhatian:</strong>
                                    Tautan verifikasi ini hanya berlaku selama
                                    <strong>{{ config('auth.verification.expire', 60) }} menit</strong>
                                    sejak email ini dikirim. Jika sudah kedaluwarsa, silakan minta tautan baru dari
                                    halaman login.
                                </p>
                            </div>

                            <!-- Divider -->
                            <div style="border-top:1px solid #f1f5f9; margin-bottom:20px;"></div>

                            <!-- Fallback URL -->
                            <p style="margin:0 0 8px; font-size:12px; color:#94a3b8; line-height:1.6;">
                                Jika tombol di atas tidak berfungsi, salin dan tempel tautan berikut ke browser Anda:
                            </p>
                            <p style="margin:0; font-size:11px; word-break:break-all;">
                                <a href="{{ $verificationUrl ?? '#' }}"
                                    style="color:#1B3A6B; text-decoration:underline;">
                                    {{ $verificationUrl ?? url('/email/verify/example-token') }}
                                </a>
                            </p>
                        </td>
                    </tr>

                    <!-- ── SECURITY NOTE ── -->
                    <tr>
                        <td
                            style="background-color:#f8fafc; padding:20px 40px; border:1px solid #e2e8f0; border-top:none;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                width="100%">
                                <tr>
                                    <td valign="top" width="24" style="padding-right:12px; padding-top:2px;">
                                        <span style="font-size:18px;">🔒</span>
                                    </td>
                                    <td>
                                        <p style="margin:0; font-size:12px; color:#64748b; line-height:1.7;">
                                            <strong style="color:#374151;">Bukan Anda yang mendaftar?</strong><br>
                                            Jika Anda tidak merasa mendaftarkan akun di KirimAja, abaikan email ini.
                                            Akun tidak akan dibuat tanpa verifikasi email. Jika Anda merasa ada
                                            aktivitas mencurigakan,
                                            segera hubungi kami di
                                            <a href="mailto:support@{{ config('app.domain', 'kirimaja.id') }}"
                                                style="color:#1B3A6B;">support@{{ config('app.domain', 'kirimaja.id') }}</a>.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- ── FEATURES ROW ── -->
                    <tr>
                        <td
                            style="background-color:#ffffff; padding:24px 40px; border:1px solid #e2e8f0; border-top:none;">
                            <p style="margin:0 0 16px; font-size:13px; font-weight:600; color:#374151;">Apa yang bisa
                                Anda lakukan
                                setelah verifikasi:</p>
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0"
                                width="100%">
                                <tr>
                                    <td valign="top" width="33%" style="padding-right:8px; text-align:center;">
                                        <div style="font-size:24px; margin-bottom:6px;">📦</div>
                                        <p
                                            style="margin:0; font-size:11px; color:#64748b; line-height:1.5; font-weight:600; color:#374151;">
                                            Buat Pengiriman</p>
                                        <p style="margin:0; font-size:10px; color:#94a3b8; line-height:1.5;">Kirim
                                            paket ke seluruh
                                            Indonesia</p>
                                    </td>
                                    <td valign="top" width="33%" style="padding: 0 8px; text-align:center;">
                                        <div style="font-size:24px; margin-bottom:6px;">📍</div>
                                        <p
                                            style="margin:0; font-size:11px; color:#374151; line-height:1.5; font-weight:600;">
                                            Lacak
                                            Paket</p>
                                        <p style="margin:0; font-size:10px; color:#94a3b8; line-height:1.5;">Pantau
                                            status pengiriman
                                            real-time</p>
                                    </td>
                                    <td valign="top" width="33%" style="padding-left:8px; text-align:center;">
                                        <div style="font-size:24px; margin-bottom:6px;">💳</div>
                                        <p
                                            style="margin:0; font-size:11px; color:#374151; line-height:1.5; font-weight:600;">
                                            Bayar
                                            Online</p>
                                        <p style="margin:0; font-size:10px; color:#94a3b8; line-height:1.5;">Berbagai
                                            metode pembayaran
                                            tersedia</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- ── FOOTER ── -->
                    <tr>
                        <td
                            style="background-color:#1e293b; padding:24px 40px; border-radius:0 0 12px 12px; text-align:center;">
                            <p style="margin:0 0 8px; font-size:13px; font-weight:700; color:#ffffff;">KirimAja</p>
                            <p style="margin:0 0 12px; font-size:11px; color:#94a3b8; line-height:1.6;">
                                Solusi Pengiriman Terpercaya untuk Seluruh Indonesia
                            </p>
                            <p style="margin:0 0 12px;">
                                <a href="{{ config('app.url') }}"
                                    style="color:#60a5fa; font-size:11px; text-decoration:none;">Website</a>
                                &nbsp;&nbsp;·&nbsp;&nbsp;
                                <a href="{{ config('app.url') }}/tracking"
                                    style="color:#60a5fa; font-size:11px; text-decoration:none;">Lacak Paket</a>
                                &nbsp;&nbsp;·&nbsp;&nbsp;
                                <a href="mailto:support@kirimaja.id"
                                    style="color:#60a5fa; font-size:11px; text-decoration:none;">Hubungi Kami</a>
                            </p>
                            <p style="margin:0; font-size:10px; color:#475569; line-height:1.6;">
                                Email ini dikirim ke <strong
                                    style="color:#64748b;">{{ $user->email ?? 'nama@email.com' }}</strong>
                                karena Anda mendaftarkan akun di KirimAja.<br>
                                © {{ date('Y') }} KirimAja. Seluruh hak dilindungi.
                            </p>
                        </td>
                    </tr>

                </table>
                <!-- END EMAIL CONTAINER -->

            </td>
        </tr>
    </table>

</body>

</html>
