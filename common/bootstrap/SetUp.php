<?php

namespace common\bootstrap;

use core\services\auth\PasswordResetService;
use core\services\ContactService;
use yii\base\BootstrapInterface;
use yii\mail\MailerInterface;

class SetUp implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $container = \Yii::$container;

        //Можно конфигурировать контейнер внедрения зависимостей илли таким путем (1) с помощью коллбэка
        /*$container->setSingleton(PasswordResetService::class, function () use ($app) {
            return new PasswordResetService([$app->params['supportEmail'] => $app->name . 'robot']);
        });*/
        // или таким (2), используя Yii-шную реализацию
        $container->setSingleton(PasswordResetService::class, [], [
            [$app->params['supportEmail'] => $app->name . 'robot']
           ]);

        $container->setSingleton(MailerInterface::class, function () use ($app) {
            return $app->mailer;
        });

        $container->setSingleton(ContactService::class, [], [
            $app->params['adminEmail']
        ]);
    }
}