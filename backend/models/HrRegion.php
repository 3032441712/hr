<?php
/**
 * 系统省市区信息模块
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
namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%region}}".
 *
 * @property integer $region_id
 * @property integer $parent_id
 * @property string $region_name
 * @property integer $region_type
 * @property integer $agency_id
 */
class HrRegion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%region}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'region_type', 'agency_id'], 'integer'],
            [['region_name'], 'string', 'max' => 120]
        ];
    }

    /**
     * 根据省市区的ID获取名称
     * 
     * @param array $ids ID数组
     * 
     * @return string
     */
    public static function getAreaTitle($ids)
    {
        $data = static::find()->onCondition(['region_id' => $ids])->select('region_name')->asArray()->all();

        return $data[0]['region_name'] . ' ' . $data[1]['region_name'] . ' ' . $data[2]['region_name'];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'region_id' => 'Region ID',
            'parent_id' => 'Parent ID',
            'region_name' => 'Region Name',
            'region_type' => 'Region Type',
            'agency_id' => 'Agency ID',
        ];
    }
}