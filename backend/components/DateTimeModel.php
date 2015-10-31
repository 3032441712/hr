<?php
namespace app\components;

use yii\db\ActiveRecord;

class DateTimeModel extends ActiveRecord
{
    /**
     * 创建更新数据时,自动填写创建时间与更新时间
     *
     * @return bool true/false
     */
    public function beforeSave($insert)
    {
        $datetime = date('Y-m-d H:i:s');
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->created_at = $datetime;
            }
            $this->updated_at = $datetime;
            return true;
        } else {
            return false;
        }
    }
}
