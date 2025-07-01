<?php 

namespace Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    protected $mailer;

    public function __construct(array $config)
    {
        $this->mailer = new PHPMailer(true);

        $this->mailer->isSMTP();
        $this->mailer->Host = $config['host'];
        $this->mailer->SMTPAuth = true;
        $this->mailer->Port = $config['port'];
        $this->mailer->Username = $config['username'];
        $this->mailer->Password = $config['password'];
        $this->mailer->SMTPSecure = $config['encryption'];

        $this->mailer->isHTML(true);
        $this->mailer->setFrom($config['from_email'], $config['from_name']);
    }

    public function sendMail($to, $subject, $body, $altBody = '')
    {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($to);
            $this->mailer->Subject = $subject;
            $this->mailer->Body    = $body;
            $this->mailer->AltBody = $altBody ?: strip_tags($body);

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            error_log("Mail error: " . $this->mailer->ErrorInfo);
            return false;
        }
    }

    protected function renderTemplate($template, $data = [])
    {
        $templatePath = base_path("Views/Emails/{$template}.view.php");

        if (!file_exists($templatePath)) {
            throw new \Exception("Email template {$template} not found.");
        }

        extract($data);
        ob_start();
        include $templatePath;
        return ob_get_clean();
    }

    public function sendTemplateEmail($to, $subject, $template, $data = [])
    {
        $body = $this->renderTemplate($template, $data);
        
        $this->sendMail($to, $subject, $body);
    }
}