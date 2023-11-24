<?php
class PHP_Email_Form
{
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $message;
    public $headers;
    public $smtp;

    public function __construct()
    {
        $this->to = '';
        $this->from_name = '';
        $this->from_email = '';
        $this->subject = '';
        $this->message = '';
        $this->headers = '';
        $this->smtp = array();
    }

    public function add_message($content, $label = '')
    {
        $this->message .= "<p>$label: $content</p>";
    }

    public function send()
    {
        $this->headers = "From: $this->from_name <$this->from_email>\r\n";
        $this->headers .= "Reply-To: $this->from_email\r\n";
        $this->headers .= "MIME-Version: 1.0\r\n";
        $this->headers .= "Content-type: text/html; charset=utf-8\r\n";

        if (!empty($this->smtp)) {
            $this->headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
            return mail($this->to, $this->subject, $this->message, $this->headers);
        } else {
            return mail($this->to, $this->subject, $this->message, $this->headers);
        }
    }
}
?>
