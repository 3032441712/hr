<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\HrPerson */

$this->title = $model->real_name;
$this->params['breadcrumbs'][] = ['label' => '编辑个人信息', 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-person-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('编辑个人信息', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'dept_id',
            'job_number',
            [
                'attribute' => 'real_name',
                'label' => '姓名'
            ],
            'sex',
            'birthday',
            'marital_status',
            'last_login',
            'province',
            'city',
            'district',
            'address',
            'zipcode',
            'qq',
            'office_phone',
            'home_phone',
            'mobile_phone',
            'entry_time',
            'salary_time',
            'working_status',
            'job_type',
            'job_station',
            'job_level',
            'attendance_type',
            'email:email',
            [
                'attribute' => 'status',
                'label' => '状态'
            ],
            [
                'attribute' => 'created_at',
                'label' => '创建时间'
            ],
            [
                'attribute' => 'updated_at',
                'label' => '更新时间'
            ],
        ],
    ]) ?>

</div>
