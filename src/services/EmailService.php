<?php

/*namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

class EmailService
{
    private $mail;
    private $provider;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->configureOAuth();
        $this->configureSMTP();
    }

    // Configuration de l'OAuth2 avec Google
    private function configureOAuth()
    {
        // Charger le fichier client_secret.json
        $json = json_decode(file_get_contents(__DIR__ . '/../../config/client_secret.json'), true);
        var_dump($json);

        // Configurer le fournisseur OAuth2 pour Google
        $this->provider = new Google([
            'clientId'     => $json['web']['client_id'],
            'clientSecret' => $json['web']['client_secret'],
            'redirectUri'  => $json['web']['redirect_uris'][0],
        ]);
    }

    // Configurer le SMTP avec OAuth2 et PHPMailer
    private function configureSMTP()
    {
        $this->mail->isSMTP();
        $this->mail->Host       = 'smtp.gmail.com';
        $this->mail->SMTPAuth   = true;
        $this->mail->AuthType   = 'XOAUTH2';

        // Obtenir le jeton d'accès OAuth2
        $accessToken = $this->provider->getAccessToken('refresh_token', [
            'refresh_token' => 'YOUR_REFRESH_TOKEN',
        ]);

        // Configurer PHPMailer pour utiliser OAuth
        $this->mail->setOAuth(new OAuth([
            'provider'     => $this->provider,
            'clientId'     => '57492085464-7lo75iica8d19k819034hogv4p8l2mcq.apps.googleusercontent.com',
            'clientSecret' => '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',
            'refreshToken' => '1//03fqinBL6QcvOCgYIARAAGAMSNwF-L9IrTJH_TFaezAYlCi2gvQQwlhkY8clPao3oi28U8A8w5Ap9MvrvnUQMqxQJUcDThMD8JEE',
            'userName'     => 'sotiba67@gmail.com'
        ]));
        
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port       = 587;
    }

    // Méthode pour envoyer un email de confirmation
    public function sendConfirmationEmail($email, $subject, $message)
    {
        try {
            // Configuration des destinataires
            $this->mail->setFrom('no-reply@votre-site.com', 'Cinéphoria');
            $this->mail->addAddress($email);

            // Contenu de l'email
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body    = $message;

            // Envoi de l'email
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            echo "Le message n'a pas pu être envoyé. Erreur : {$this->mail->ErrorInfo}";
            return false;
        }
    }
}*/