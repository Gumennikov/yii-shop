<?php

namespace core\services;

use core\forms\ContactForm;
use yii\mail\MailerInterface;

class ContactService
{
    private $adminEmail;
    private $mailer;

    /**
     * ContactService constructor.
     * @param $adminEmail
     * @param MailerInterface $mailer
     */
    public function __construct($adminEmail, MailerInterface $mailer)
    {
        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;
    }

    /**
     * @param ContactForm $form
     */
    public function send(ContactForm $form): void
    {
        $sent = $this->mailer->compose()
        ->setFrom($this->adminEmail)
        ->setSubject($form->subject)
        ->setTextBody($form->body)
        ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }
    }
}