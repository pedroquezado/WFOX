<?php
function send_email_register($email,$nome,$site){
    // Compo E-mail
    $arquivo = '
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="font-family: Arial, sans-serif;">
        <tr>
            <td align="center" bgcolor="#1e293d" style="padding: 40px 0 30px 0;">
                <img src="http://imgh.us/logo-branco.svg" alt="Criando Mágica de E-mail" width="100" style="display: block;" />
            </td>
        </tr>
        <tr>
            <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr align="center">
                        <td style="color: #153643; font-size: 24px;">
                            Ola, <i>' . $nome . '!</i>
                        </td>
                    </tr>
                    <tr align="center" style="color: #153643; font-size: 16px; line-height: 20px;"
                        >
                        <td style="padding: 20px 0 30px 0;">
                            <b>Sua conta foi criada</b>
                            <br>
                            Oba! Temos mais um membro na comunidade.
                        </td>
                    </tr>
                    <tr align="center" style="color: #153643; font-size: 16px; line-height: 20px;"
                        >
                        <td style="padding: 20px 0 30px 0;">
                            Para mais informações acesse, <a href="' . $site . '">' . $site . '</a>.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#ea2c46" style="padding: 30px 30px 30px 30px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                        <td width="100%" align="center" style="font-size: 12px;text-transform: uppercase;">© 2017 WFOX, Inc.</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
      ';

    //enviar

    // emails para quem será enviado o formulário
    $emailenviar = $email;
    $destino = $emailenviar;
    $assunto = "Contato pelo Site";

    // É necessário indicar que o formato do e-mail é html
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: $nome <$email>';
    //$headers .= "Bcc: $EmailPadrao\r\n";
      
    $enviaremail = mail($destino, $assunto, $arquivo, $headers);
}
?>