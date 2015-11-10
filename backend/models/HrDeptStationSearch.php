<?php
/**
 * 部门岗位信息数据检索模块
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

use yii\base\Model;
use yii\data\ActiveDataProvider;

class HrDeptStationSearch extends HrDeptStation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dept_id'], 'integer'],
        ];
    }
    
    public function scenarios()
    {
        return Model::scenarios();
    }
    
    /**
     * 可以根据部门ID检索岗位
     * 
     * @param array $params 参数
     * 
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = HrDeptStation::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        $query->andFilterWhere([
            'dept_id' => $this->dept_id,
        ]);
        
        return $dataProvider;
    }
}