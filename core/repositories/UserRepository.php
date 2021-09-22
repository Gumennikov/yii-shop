<?php

namespace core\repositories;

use core\entities\user\User;

class UserRepository
{
    public function getByEmail(string $email): User
    {
        return $this->getBy(['email' => $email]);
    }

    public function getByEmailConfirmToken(string $token): User
    {
        return $this->getBy(['verification_token' => $token]);
    }

    public function getByPasswordResetToken(string $token): User
    {
        return $this->getBy(['password_reset_token' => $token]);
    }

    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function existByPasswordResetToken(string $token): bool
    {
        return (bool) User::findByPasswordResetToken($token);
    }

    private function getBy(array $condition): User
    {
        if (!$user = User::findOne([$condition])) {
            throw new NotFoundException('User not found.');
        }
        return $user;
    }

    public function findByNetworkIdentity($network, $identity): ?User
    {
        $user = User::find()->joinWith('networks n')->andWhere(['n.network' => $network, 'n.identity' => $identity])->one();
        if ($user) {
            return User::findOne(['id' => $user->getId()]);
        }
        throw new NotFoundException('User not found.');
    }

    public function findByUsernameOrEmail($value): ?User
    {
        return User::find()->where(['OR', ['username' => $value], ['email' => $value]])->limit(1)->one();
    }
}
