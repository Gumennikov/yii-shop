<?php


namespace core\services\auth;


use core\entities\user\User;
use core\forms\auth\LoginForm;
use core\repositories\UserRepository;

class AuthService
{
    private $user;

    public function __construct(UserRepository $users)
    {
        $this->user = $users;
    }

    public function auth(LoginForm $form): User
    {
        $user = $this->user->findByUsernameOrEmail($form->username);
        if (!$user || !$user->isActive() || !$user->validatePassword($form->password)) {
            throw new \DomainException('Undefined user or password.');
        }
        return $user;
    }
}