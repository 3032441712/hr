<?php
/**
 * 系统导航按钮
 *
 * PHP version 5.5
 *
 * @author   zhaoyan <1210965963@qq.com>
 * @license  http://www.168helps.com License
 * @version  GIT: $Id$
 * @link     https://github.com/3032441712/hr
 */
use common\widgets\Menu;
use app\components\RoleAuthComponent;

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
                'icon' => 'fa-user',
                'visible' => RoleAuthComponent::getAdminRole(),
                'options' => [
                    'class' => 'treeview',
                 ],
                'items' => [
                    [
                        'label' => '添加员工',
                        'url' => ['/user/create'],
                        'icon' => 'fa fa-plus-square-o',
                    ],
                    [
                        'label' => '员工管理',
                        'url' => ['/user/index'],
                        'icon' => 'fa fa-table',
                    ],
                    [
                        'label' => '操作日志',
                        'url' => ['/user/log'],
                        'icon' => 'fa fa-minus-square-o',
                    ]
                ]
            ],
            [
            'label' => '部门管理',
                'url' => ['#'],
                'icon' => 'fa-folder',
                'visible' => RoleAuthComponent::getAdminRole(),
                'options' => [
                    'class' => 'treeview',
                 ],
                'items' => [
                    [
                        'label' => '添加部门',
                        'url' => ['/dept/create'],
                        'icon' => 'fa fa-plus-square-o',
                    ],
                    [
                        'label' => '部门管理',
                        'url' => ['/dept/index'],
                        'icon' => 'fa fa-table',
                    ],
                    [
                        'label' => '添加岗位',
                        'url' => ['/dept-station/create'],
                        'icon' => 'fa fa-plus-square-o',
                    ],
                    [
                        'label' => '岗位管理',
                        'url' => ['/dept-station/index'],
                        'icon' => 'fa fa-table',
                    ],
                    [
                        'label' => '操作日志',
                        'url' => ['/dept/log'],
                        'icon' => 'fa fa-minus-square-o',
                    ]
                ]
            ],
            [
                'label' => '公告管理',
                'url' => ['#'],
                'icon' => 'fa fa-envelope',
                'visible' => RoleAuthComponent::getAdminRole(),
                'options' => [
                    'class' => 'treeview',
                 ],
                'items' => [
                    [
                        'label' => '公告管理',
                        'url' => ['/notice/index'],
                        'icon' => 'fa fa-envelope-o',
                    ],
                    [
                        'label' => '操作日志',
                        'url' => ['/notice/log'],
                        'icon' => 'fa fa-minus-square-o',
                    ]
                ]
            ],
            [
                'label' => '我的部门',
                'url' => ['#'],
                'icon' => 'fa fa-heart',
                'visible' => RoleAuthComponent::getDeptMasterRole(),
                'options' => [
                    'class' => 'treeview',
                ],
                'items' => [
                    [
                        'label' => '成员列表',
                        'url' => ['/master-dept/index'],
                        'icon' => 'fa fa-table',
                    ]
                ]
            ],
            [
                'label' => '打卡管理',
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-folder',
                'visible' => false,
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
                'visible' => false,
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
                'visible' => false,
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
                'visible' => false,
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
                'visible' => false,
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