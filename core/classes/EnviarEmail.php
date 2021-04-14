<?php

namespace core\classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EnviarEmail{

    // =========================================================
    public function enviar_email_confirmacao_novo_cliente($email_cliente, $purl){

        // envia um e-mail para o novo cliente no sentido de confirmar o e-mail

        // constrói o purl (link para validação do e-mail)
        $link = BASE_URL . '?a=confirmar_email&purl=' . $purl;

        $mail = new PHPMailer(true);

        try {
            //opções do servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host       = EMAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = EMAIL_FROM;
            $mail->Password   = EMAIL_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = EMAIL_PORT;
            $mail->CharSet    = 'UTF-8';                                   

            //Emissor e receptor
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email_cliente);     

            // assunto
            $mail->isHTML(true);                                  
            $mail->Subject = APP_NAME . ' - Confirmação de e-mail.';

            // mensagem
            $html = '<p>Seja bem vindo à nossa loja ' . APP_NAME . '!</p>';
            $html .= '<p>Para poder entrar na nossa loja, é necessário confirmar o seu e-mail.</p>';
            $html .= '<p>Para confimar o e-mail, clique no link abaixo:</p>';
            $html .= '<p><a href="'.$link.'">Confirmar E-mail</a></p>';
            $html .= '<p><i><small>'. APP_NAME .'</small></i></p>';

            $mail->Body = $html;
            
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }

    }

}