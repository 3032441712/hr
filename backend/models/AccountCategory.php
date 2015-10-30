<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "account_category".
 *
 * @property integer $cat_id
 * @property string $cat_title
 * @property integer $cat_parent
 * @property integer $cat_status
 * @property integer $cat_count
 * @property string $createtime
 * @property string $updated
 */
class AccountCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_parent', 'cat_status', 'cat_count'], 'integer'],
            [['createtime'], 'required'],
            [['createtime', 'updated'], 'safe'],
            [['cat_title'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => '主键ID',
            'cat_title' => '分类标题',
            'cat_parent' => '父级分类',
            'cat_status' => '分类状态',
            'cat_count' => '分类统计',
            'createtime' => '创建时间',
            'updated' => 'Updated',
        ];
    }
}
