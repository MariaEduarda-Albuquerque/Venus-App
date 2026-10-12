{{-- ONDE SALVAR: resources/views/emails/codigo-redefinicao.blade.php --}}
{{-- (se as pastas "emails" não existirem dentro de resources/views, cria elas) --}}

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Código de redefinição de senha</title>
</head>
<body style="margin:0; padding:0; background-color:#F6A9BC; font-family: Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="padding: 32px 16px;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" style="max-width:420px; background-color:#FDF1F3; border-radius:24px; padding:32px;">
                    <tr>
                        <td align="center" style="padding-bottom: 16px;">
                            {{--
                                Logo da Vênus, embutida DENTRO do e-mail (em vez de
                                linkar uma URL), usando $message->embed(). O Laravel
                                injeta a variável $message automaticamente em toda
                                view de e-mail renderizada via ->view() no Mailable —
                                não precisa passar ela manualmente.

                                A vantagem de usar embed() em vez de asset(): a imagem
                                vai junto DENTRO da mensagem (como um anexo inline),
                                então o Gmail não precisa buscar nada na sua rede
                                local — funciona mesmo com o back-end rodando em
                                localhost/IP local, sem precisar de deploy nem ngrok.
                            --}}
                            <img
                                src="{{ $message->embed(public_path('images/Venus.jpeg')) }}"
                                alt="Vênus"
                                width="64"
                                height="64"
                                style="display:block; width:64px; height:64px; border-radius:32px;"
                            >
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="color:#8B1E3B; font-size:20px; font-weight:bold; padding-bottom: 8px;">
                            Redefinição de senha
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="color:#3A0E1D; font-size:14px; padding-bottom: 24px;">
                            Use o código abaixo para criar uma nova senha. Ele vale por 15 minutos.
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding-bottom: 24px;">
                            <div style="display:inline-block; background-color:#FBDCE3; border-radius:16px; padding:16px 28px; font-size:28px; font-weight:bold; letter-spacing:8px; color:#7D1934;">
                                {{ $codigo }}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="color:#3A0E1D; font-size:12px; opacity:0.75;">
                            Se você não pediu essa redefinição, pode ignorar este e-mail com segurança.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>