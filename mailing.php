<?php
require './vendor/autoload.php';
$list_arg = [
    "content:",
    "from:",
    "from-name:",
    "subject:",
    "sendgrid-key:",
    "recipients-file:",
    "category:",

];
$arg = getopt("", $list_arg);
if (count($arg) != 7){
    echo 'Argument missing';
    exit(1);
}
$file = file($arg['recipients-file']);
$chunk = array_chunk($file, 1000);
$sendgrid = new SendGrid($arg['sendgrid-key']);

array_map(
    function($emails) use ($content, $sendgrid, $arg) {
        $email = new \SendGrid\Email();
        $email
            ->setSmtpapiTos($emails)
            ->setFrom($arg['from'])
            ->setFromName($arg['from-name'])
            ->setCategory($arg['category'])
            ->setSubject($arg['subject'])
            ->setHtml($arg['content'])
        ;
        try {
            $sendgrid->send($email);
        } catch(\SendGrid\Exception $e) {
            echo $e->getCode();
            foreach($e->getErrors() as $er) {
                echo $er;
            }
        }
    },
    $chunk
);

