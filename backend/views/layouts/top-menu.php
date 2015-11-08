<?php
use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\helpers\Html;

$menuItems = [
    [
        'label' => Yii::t('app', 'Home'),
        'url' => ['/site/index']
    ],
    [
        'label' => '<i class="glyphicon glyphicon-user"></i> <span>'.Yii::$app->user->identity->real_name.'</span> ',
        'url' => ['#'],
        'active' => false,
        'items' => [
            [
                'label' => '<li class="user-header bg-light-blue"><img src="adminlte/img/avatar3.png" class="img-circle" alt="User Image"><p>'.Yii::$app->user->identity->real_name.' - PHP工程师<small>入职时间 2015-10-01</small></p></li>'
            ],
            [
                'label' => '<li class="user-footer"><div class="pull-left"><a href="#" class="btn btn-default btn-flat">个人信息</a></div><div class="pull-right">'.Html::a('注销系统', ['site/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']).'</div></li>'
            ]
        ],
        'options' => ['class' => 'dropdown user user-menu']
    ]
];
echo '<div class="navbar-right">'.Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => $menuItems,
    'encodeLabels' => false,
]).'</div>';

// $menuItemsMain = [
//     [
//         'label' => '<i class="fa fa-cog"></i> 个人信息',
//         'url' => ['#'],
//         'active' => false,
//         'items' => [
//             [
//                 'label' => '<i class="fa fa-user"></i> 信息分类',
//                 'url' => ['/account-category'],
//             ],
//             [
//                 'label' => '<i class="fa fa-user-md"></i> 信息列表',
//                 'url' => ['/account'],
//             ],
//         ],
//         'visible' => Yii::$app->user->can('account'),
//     ],
//     [
//         'label' => '<i class="fa fa-cog"></i> ' . Yii::t('app', 'System'),
//         'url' => ['#'],
//         'active' => false,
//         //'visible' => Yii::$app->user->can('haha'),
//         'items' => [
//             [
//                 'label' => '<i class="fa fa-user"></i> ' . Yii::t('app', 'User'),
//                 'url' => ['/user'],
//             ],
//             [
//                 'label' => '<i class="fa fa-lock"></i> ' . Yii::t('app', 'Role'),
//                 'url' => ['/role'],
//             ],
//         ],
//         'visible' => Yii::$app->user->can('admin'),
//     ],
// ];
// Nav::widget([
//     'options' => ['class' => 'navbar-nav navbar-left'],
//     'items' => $menuItemsMain,
//     'encodeLabels' => false,
// ]);

