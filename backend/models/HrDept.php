<?php

namespace app\models;

use Yii;
use app\components\DateTimeModel;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%dept}}".
 *
 * @property string $id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 */
class HrDept extends DateTimeModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dept}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'title' => '部门名称',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * 获取部门数据
     *
     * @return array
     */
    public static function getArrayDept()
    {
        return ArrayHelper::map(self::find()->select('id, title')->asArray()->all(), 'id', 'title');
    }
}
