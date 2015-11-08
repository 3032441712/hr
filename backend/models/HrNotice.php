<?php

namespace app\models;

use Yii;
use app\components\DateTimeModel;

/**
 * This is the model class for table "hr_notice".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class HrNotice extends DateTimeModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hr_notice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
    
    public static function getLastNoticeArray()
    {
        return self::find()->orderBy('id DESC')->limit('1')->asArray()->one();
    }
}