<?php

namespace core\forms\manage\User;

use core\entities\User\User;
use yii\base\Model;
use Yii;
use yii\helpers\ArrayHelper;

class UserCreateForm extends Model
{
    public $username;
    public $email;
    //public $phone;
    public $password;
    public $role;

    public function rules(): array
    {
        return [
            [['username', 'email'], 'required'],
            ['email', 'email'],
            [['username', 'email'], 'string', 'max' => 255],
            [['username', 'email'], 'unique', 'targetClass' => User::class],
            ['password', 'string', 'min' => Yii::$app->params['passwordMinLength']],
            //['phone', 'integer'],
        ];
    }

    /*public function rolesList(): array
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
    }*/
}