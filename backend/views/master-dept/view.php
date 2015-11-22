<?php

use yii\widgets\DetailView;
use app\models\HrRegion;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->real_name;
$this->params['breadcrumbs'][] = ['label' => '我的联系人', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'job_number',
            'real_name',
            [
                'attribute' => 'sex',
                'value' => $model->sexLabel
            ],
            [
                'attribute' => 'dept_id',
                'value' => $model->deptLabel,
            ],
            'email:email',
            [
                'attribute' => 'sex',
                'value' => $model->sexLabel,
            ],
            'birthday',
            [
                'attribute' => 'marital_status',
                'value' => $model->maritalStatusLabel
            ],
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
            [
                'attribute' => 'status',
                'value' => $model->statusLabel,
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
