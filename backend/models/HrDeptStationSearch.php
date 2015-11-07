<?php
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