<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
</head>
<body style="margin:0;padding:0;font-family:Segoe UI,Roboto,Helvetica,Arial,sans-serif;font-size:15px;line-height:1.55;color:#334155;background:#f8fafc;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;padding:24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" style="max-width:560px;background:#ffffff;border-radius:12px;border:1px solid #e2e8f0;overflow:hidden;">
                    <tr>
                        <td style="padding:20px 24px;background:#E30613;color:#fff;font-weight:700;font-size:16px;">
                            {{ config('app.name') }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:24px;">
                            <p style="margin:0 0 16px;">Bonjour {{ $contactName }},</p>
                            <div style="white-space:pre-wrap;margin:0 0 20px;">{!! nl2br(e($replyBody)) !!}</div>
                            <div style="margin:0;font-size:13px;color:#64748b;line-height:1.6;white-space:pre-wrap;">{!! nl2br(e($replyClosing)) !!}</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 24px;background:#f1f5f9;border-top:1px solid #e2e8f0;font-size:12px;color:#64748b;">
                            <strong>Votre message initial :</strong>
                            @if($originalSubject)
                                <div style="margin-top:6px;">Sujet : {{ $originalSubject }}</div>
                            @endif
                            <div style="margin-top:8px;white-space:pre-wrap;">{{ $originalMessage }}</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
