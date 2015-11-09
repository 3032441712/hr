<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\HrRegion;

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
            [
                'attribute' => 'created_at',
                'label' => '创建时间',
                'value' => date('Y-m-d H:i:s', $model->created_at)
            ],
            [
                'attribute' => 'updated_at',
                'label' => '更新时间',
                'value' => date('Y-m-d H:i:s', $model->updated_at)
            ],
        ],
    ]) ?>

</div>
