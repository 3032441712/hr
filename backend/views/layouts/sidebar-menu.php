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
                'url' => ['#'],
                'icon' => 'fa-users',
                'options' => [
                    'class' => 'treeview',
                 ],
                'items' => [
                    [
                        'label' => '员工管理',
                        'url' => ['/user/index'],
                        'icon' => 'fa fa-user',
                    ]
                ]
            ],
            [
            'label' => '部门管理',
                'url' => ['#'],
                'icon' => 'fa-folder',
                'options' => [
                    'class' => 'treeview',
                 ],
                'items' => [
                    [
                        'label' => '部门管理',
                        'url' => ['/dept/index'],
                        'icon' => 'fa fa-folder-o',
                    ]
                ]
            ],
            [
                'label' => '公告管理',
                'url' => ['#'],
                'icon' => 'fa fa-envelope',
                'options' => [
                    'class' => 'treeview',
                 ],
                'items' => [
                    [
                        'label' => '公告管理',
                        'url' => ['/notice/index'],
                        'icon' => 'fa fa-envelope-o',
                    ]
                ]
            ],
            [
                'label' => '打卡管理',
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-folder',
                'items' => [
                    [
                        'label' => '打卡管理',
                        'url' => ['/punch/index'],
                        'icon' => 'fa fa-user',
                    ]
                ]
            ],
            [
                'label' => '请假管理',
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-folder',
                'items' => [
                    [
                        'label' => '请假管理',
                        'url' => ['/leave/index'],
                        'icon' => 'fa fa-user',
                    ]
                ]
            ],
            [
                'label' => '物料管理',
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-folder',
                'items' => [
                    [
                        'label' => '物料管理',
                        'url' => ['/materiel/index'],
                        'icon' => 'fa fa-user',
                    ]
                ]
            ],
            [
                'label' => '系统列表',
                'url' => ['/os/index'],
                'icon' => 'fa-folder',
                'items' => [
                    [
                        'label' => '系统列表',
                        'url' => ['/os/index'],
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
                        'label' => Yii::t('app', 'Role'),
                        'url' => ['/role/index'],
                        'icon' => 'fa fa-lock',
                    ],
                ],
            ],
        ]
    ]
);