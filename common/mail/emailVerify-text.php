<?php

/* @var $this yii\web\View */

use core\entities\user\User;

/* @var $user User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['verify-email', 'token' => $user->verification_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to verify your email:

<?= $verifyLink ?>
