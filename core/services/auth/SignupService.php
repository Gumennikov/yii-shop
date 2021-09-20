<?php

namespace core\services\auth;

use core\entities\user\User;
use core\forms\auth\SignupForm;
use yii\mail\MailerInterface;

class SignupService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Signs up new user
     * @param SignupForm $form
     * @return void
     */
    public function signup(SignupForm $form): void
    {
        /*if (User::find()->andWhere(['username' => $form->username])) {
            throw new \DomainException('Username is already exist.');
        }
        if (User::find()->andWhere(['email' => $form->email])) {
            throw new \DomainException('Email is already exist.');
        }*/

        $user = User::requestSignup(
            $form->username,
            $form->email,
            $form->password
        );

        $this->save($user);

        $sent = $this->mailer->compose(
            ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
            ['user' => $user]
            )
            ->setTo($form->email)
            ->setSubject('Signup contact for ' . \Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Email sending error.');
        }
    }

    public function confirm($token): void
    {
        if (empty($token)) {
            throw new \DomainException('Empty confirm token');
        }

        $user = $this->getByEmailConfirmToken($token);
        $user->confirmSignup();
        $this->save($user);
    }

    private function save(User $user):void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    private function getByEmailConfirmToken(string $token): User
    {
        if($user = User::findOne(['verification_token' => $token])) {
            throw new \DomainException('User is not found.');
        }

        return $user;
    }
}