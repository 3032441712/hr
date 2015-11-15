<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\HrRegion;

/* @var $this yii\web\View */
/* @var $model backend\models\HrPerson */

$this->title = $model->real_name;
// $this->params['breadcrumbs'][] = ['label' => '编辑个人信息', 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-person-view">

    <p>
        <?= Html::a('修改密码', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'dept_id',
                'value' => $model->deptLabel,
            ],
            'job_number',
            [
                'attribute' => 'real_name',
                'label' => '姓名'
            ],
            [
                'attribute' => 'sex',
                'value' => $model->sexLabel
            ],
            'birthday',
            [
                'attribute' => 'marital_status',
                'value' => $model->maritalStatusLabel
            ],
            'last_login',
            [
                'label' => '户籍所在地',
                'attribute' => 'address',
                'value' => HrRegion::getAreaTitle([$model->province,$model->city,$model->district]).' '.$model->address
            ],
            'zipcode',
            'qq',
            'office_phone',
            'home_phone',
            'mobile_phone',
            'entry_time',
            'salary_time',
            [
                'attribute' => 'working_status',
                'value' => $model->workingStatusLabel
            ],
            [
                'attribute' => 'job_type',
                'value' => $model->jobTypeLabel
            ],
            [
                'attribute' => 'job_station',
                'value' => $model->jobStationLabel
            ],
            [
                'attribute' => 'job_level',
                'value' => $model->jobLevelLabel
            ],
            [
                'attribute' => 'attendance_type',
                'value' => $model->attendanceTypeLabel
            ],
            'email:email',
            [
                'attribute' => 'status',
                'label' => '状态',
                'value' => $model->statusLabel
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
