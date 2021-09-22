<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => [
        'common\bootstrap\SetUp',
    ],
    'components' => [
        'cache' => [
            'cachePath' => '@common/runtime/cache',
            'class' => 'yii\caching\FileCache',
            //Для больших проектов предпочиттельнее использовать Memcached
            //'class' => 'yii\caching\MemCache',
            //'useMemcached' => true,
        ],
    ],
    'name' => 'РИБСП'
];
