<?php

namespace App\Helpers;

use Exception;

class SendMailMasive
{
    protected $to;
    protected $title;
    protected $message;
    protected $headers = [];

    public function __construct(string $template, string $to, string $title)
    {
        $this->to = $to;
        $this->title = $title;
        $this->message = $template;
        $this->setHeaders();
        $this->createMail();
    }

    protected function setHeaders()
    {
        $this->headers = [
            'MIME-Version: 1.0',
            'Content-type: text/html; charset=UTF-8',
            'From: EduardSearch <no-reply@eduardsearch.com>',
            'Reply-To: no-reply@eduardsearch.com',
            'X-Mailer: PHP/' . phpversion()
        ];
    }

    public function createMail()
    {
        try {
            ini_set('display_errors', 1);
            error_reporting(E_ALL);

            $headers = implode("\r\n", $this->headers);

            return mail($this->to, $this->title, $this->message, $headers);
        } catch (Exception $e) {
            // Log the error message if needed
            return false;
        }
    }
}
?>