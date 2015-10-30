<?php
use common\widgets\Menu;

echo Menu::widget(
    [
        'options' => [
            'class' => 'sidebar-menu'
        ],
        'items' => [
            [
                'label' => Yii::t('app', 'Dashboard'),
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-dashboard',
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],
            [
                'label' => '员工管理',
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-dashboard',
                'items' => [
                    [
                        'label' => '员工管理',
                        'url' => ['/dept/index'],
                        'icon' => 'fa fa-user',
                    ]
                ]
            ],
            [
            'label' => '部门管理',
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-dashboard',
                'items' => [
                    [
                        'label' => '部门管理',
                        'url' => ['/dept/index'],
                        'icon' => 'fa fa-user',
                    ]
                ]
            ],
            [
                'label' => '打卡管理',
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-dashboard',
                'items' => [
                    [
                        'label' => '打卡管理',
                        'url' => ['/dept/index'],
                        'icon' => 'fa fa-user',
                    ]
                ]
            ],
            [
                'label' => '请假管理',
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-dashboard',
                'items' => [
                    [
                        'label' => '请假管理',
                        'url' => ['/dept/index'],
                        'icon' => 'fa fa-user',
                    ]
                ]
            ],
            [
                'label' => '物料管理',
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-dashboard',
                'items' => [
                    [
                        'label' => '物料管理',
                        'url' => ['/dept/index'],
                        'icon' => 'fa fa-user',
                    ]
                ]
            ],
            [
                'label' => '常用系统',
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-dashboard',
                'items' => [
                    [
                        'label' => '物料系统',
                        'url' => ['/dept/index'],
                        'icon' => 'fa fa-user',
                    ]
                ]
            ],
            [
                'label' => Yii::t('app', 'System'),
                'url' => ['#'],
                'icon' => 'fa fa-cog',
                'options' => [
                    'class' => 'treeview',
                ],
                'visible' => Yii::$app->user->can('admin'),
                'items' => [
                    [
                        'label' => Yii::t('app', 'User'),
                        'url' => ['/user/index'],
                        'icon' => 'fa fa-user',
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                    [
                        'label' => Yii::t('app', 'Role'),
                        'url' => ['/role/index'],
                        'icon' => 'fa fa-lock',
                    ],
                ],
            ],
        ]
    ]
);