<?php

namespace backend\models;

use Yii;
use app\components\DateTimeModel;
use app\models\HrDept;

/**
 * This is the model class for table "{{%dept_station}}".
 *
 * @property string $id
 * @property string $dept_id
 * @property string $title
 * @property string $created_at
 * @property string $updated_at
 */
class HrDeptStation extends DateTimeModel
{
    private $_deptLabel;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%dept_station}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dept_id'], 'integer'],
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
            'id' => '岗位ID',
            'dept_id' => '部门ID',
            'title' => '岗位名称',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
    
    public function getDeptLabel()
    {
        $this->_deptLabel = '无';
        if (empty($this->dept_id) == false) {
            $this->_deptLabel = HrDept::findOne(['id' => $this->dept_id])->title;
        }
        
        return $this->_deptLabel;
    }
}
