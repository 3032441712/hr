<?php
/**
 * 部门岗位信息数据处理模块
 *
 * PHP version 5.5
 *
 * @category backend\models
 * @package  backend\models
 * @author   zhaoyan <1210965963@qq.com>
 * @license  http://www.168helps.com License
 * @version  GIT: $Id$
 * @link     https://github.com/3032441712/hr
 */
namespace backend\models;

use Yii;
use app\components\DateTimeModel;
use app\models\HrDept;
use app\models\HrLog;

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
    
    /**
     * 获取岗位所属部门的名称
     * 
     * @return string
     */
    public function getDeptLabel()
    {
        $this->_deptLabel = '无';
        if (empty($this->dept_id) == false) {
            $this->_deptLabel = HrDept::findOne(['id' => $this->dept_id])->title;
        }
        
        return $this->_deptLabel;
    }
    
    /**
     * 根据主键ID获取岗位名称
     * 
     * @param integer $id 主键ID
     * 
     * @return string
     */
    public static function getTitleByPrimaryKey($id)
    {
        return static::findOne(['id' => $id])->title;
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
            $content = '新增岗位: '.$this->title.'('.$this->id.')';
        } else {
            $content = '编辑岗位: '.$this->title.'('.$this->id.'), 修改前数据:'.json_encode($changedAttributes);
        }

        HrLog::saveSystemLog(HrLog::DEPT_ACTION, $content);
        parent::afterSave($insert, $changedAttributes);
    }
}
