<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%dept}}".
 *
 * @property string $id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 */
class HrDept extends \yii\db\ActiveRecord
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
            [['created_at', 'updated_at'], 'required'],
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
}
