<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body style="margin:0; padding:0; background-color:#f6faf7; font-family:Arial, Helvetica, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="padding:30px 0;">
        <tr>
            <td align="center">

                <!-- Card -->
                <table width="100%" cellpadding="0" cellspacing="0" style="max-width:520px; background:#ffffff; border-radius:12px; box-shadow:0 8px 24px rgba(0,0,0,.08); padding:30px;">

                    <!-- Content -->
                    <tr>
                        <td style="color:#0f172a; font-size:15px; line-height:1.6;">
                            <p style="margin:0 0 12px;">Halo,</p>

                            <p style="margin:0 0 18px;">
                                Anda menerima email ini karena ada permintaan untuk mereset password akun Anda.
                            </p>

                            <p style="text-align:center; margin:24px 0;">
                                <a href="{{ $url }}"
                                   style="
                                   display:inline-block;
                                   padding:12px 22px;
                                   background:#189e1e;
                                   color:#ffffff;
                                   text-decoration:none;
                                   font-weight:700;
                                   border-radius:8px;
                                   ">
                                    Reset Password
                                </a>
                            </p>

                            <p style="margin:18px 0;">
                                Jika tombol di atas tidak berfungsi, silakan salin dan tempel tautan berikut ke browser Anda:
                            </p>

                            <p style="word-break:break-all; color:#189e1e;">
                                <a href="{{ $url }}" style="color:#189e1e;">{{ $url }}</a>
                            </p>

                            <p style="margin-top:20px; color:#64748b; font-size:13px;">
                                Link ini berlaku selama <strong>60 menit</strong>.
                            </p>

                            <p style="margin-top:24px;">
                                Jika Anda tidak merasa meminta reset password, abaikan email ini.
                            </p>

                            <p style="margin-top:24px;">
                                Salam,<br>
                                <strong>Tim Laboratorium Lingkungan</strong>
                            </p>
                        </td>
                    </tr>

                </table>

                <!-- Footer -->
                <p style="margin-top:16px; font-size:12px; color:#94a3b8;">
                    © {{ date('Y') }} Laboratorium Lingkungan
                </p>

            </td>
        </tr>
    </table>

</body>
</html>
