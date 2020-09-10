<?php
require_once "Mail.php";
require_once "Mail/mime.php";

class Email
{
    function __construct($config)
    {
        if(!is_array($config))
        {
            die("Invalid content is not array!");
        }

        $this->emailUsername = $config["emailusername"];
        $this->emailTo = $config["emailto"];
        $this->emailSubject = $config["emailsubject"];
        $this->emailHost = $config["emailhost"];
        $this->emailPort = $config["emailport"];
        $this->emailAuth = $config["emailauth"];
        $this->emailPassword = $config["emailpassword"];
        $this->emailTemplate = $config["emailtemplate"];
        $this->emailAttachment = $config["emailattachment"];
    }

    function SendEmail()
    {
        $headers = array(
        "From"          => $this->emailUsername,
        "To"           => $this->emailTo,
        "Subject"       => $this->emailSubject,
        "Content-Type"  => "text/html; charset=UTF-8");
        
        $params = array(
        "host"      => $this->emailHost,
        "port"      => $this->emailPort,
        "auth"      => $this->emailAuth,
        "username"  => $this->emailUsername,
        "password"  => $this->emailPassword);

        $html = $this->emailTemplate;
        $crlf = "\n";
        
        $mime = new Mail_mime($crlf);
        $mime->setHTMLBody($html);
        if ($this->emailAttachment != "")
        {
            $mime->addAttachment($this->emailAttachment, "application/pdf");
        }

        $mime_params = array(
        "text_encoding" => "7bit",
        "text_charset"  => "UTF-8",
        "html_charset"  => "UTF-8",
        "head_charset"  => "UTF-8");
        
        $body = $mime->get($mime_params);
        $headers = $mime->headers($headers);
        
        $smtp = Mail::factory("smtp", $params);
        $mail = $smtp->send($this->emailTo, $headers, $body);
        
        if (PEAR::isError($mail))
        {
            echo($mail->getMessage());
        }
    }
}
?>