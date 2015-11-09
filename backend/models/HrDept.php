<?php

namespace app\models;

use Yii;
use app\components\DateTimeModel;
use yii\helpers\ArrayHelper;
use backend\models\User;

/**
 * This is the model class for table "{{%dept}}".
 *
 * @property string $id
 * @property integer $master_user
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 */
class HrDept extends DateTimeModel
{
    private $_userLabel = '';

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
            [['master_user'], 'integer'],
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
            'master_user' => '部门经理',
            'title' => '部门名称',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    public function getUserLabel()
    {
        if ($this->master_user > 0) {
            $this->_userLabel = User::findOne(['id' => $this->master_user])->real_name;
        }

        return $this->_userLabel;
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

    /**
     * 数据保存之后写入日志文件
     *
     * @return void
     */
    public function afterSave($insert, $changedAttributes)
    {
        $content = '';
        if ($insert) {
            $content = '新增部门: '.$this->title.'('.$this->id.')';
        } else {
            $content = '编辑部门: '.$this->title.'('.$this->id.'), 修改前数据:'.json_encode($changedAttributes);
        }

        HrLog::saveSystemLog(HrLog::DEPT_ACTION, $content);
        parent::afterSave($insert, $changedAttributes);
    }
}
