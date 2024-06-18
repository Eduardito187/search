<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\View;

class SendMailMasive
{
    protected $to;
    protected $title;
    protected $message;
    protected $headers = [];

    public function __construct(string $title, string $to, string $template)
    {
        $this->to = $to;
        $this->title = $title;
        $this->message = $this->renderView("mail.mailing", ["name" => $title, "template" => $template]);
        $this->setHeaders();
        $this->createMail();
    }

    protected function renderView($view, $data)
    {
        if (View::exists($view)) {
            return View::make($view, $data)->render();
        }

        throw new Exception("View {$view} not found");
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

            return mail($this->to, $this->title, "HOLA", $headers);
        } catch (Exception $e) {
            return false;
        }
    }
}
?>