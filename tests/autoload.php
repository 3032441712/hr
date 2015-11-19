<?php
require(dirname(__DIR__) . '/vendor/autoload.php');
require(dirname(__DIR__) . '/vendor/yiisoft/yii2/Yii.php');

require(dirname(__DIR__) . '/common/config/bootstrap.php');
require(dirname(__DIR__) . '/backend/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require(dirname(__DIR__) . '/common/config/main.php'),
    require(dirname(__DIR__) . '/common/config/main-local.php'),
    require(dirname(__DIR__) . '/backend/config/main.php'),
    require(dirname(__DIR__) . '/backend/config/main-local.php')
);

new yii\web\Application($config);
