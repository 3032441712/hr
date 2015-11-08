<?php
/**
 * 数据库基本组件,数据创建更新时,
 * 记录更新数据的时间.
 *
 * PHP version 5.5
 *
 * @category app\components
 * @package  app\components
 * @author   zhaoyan <1210965963@qq.com>
 * @license  http://www.168helps.com License
 * @version  GIT: $Id$
 * @link     https://github.com/3032441712/hr
 */
namespace app\components;

use yii\db\ActiveRecord;

/**
 * 数据库基本组件,数据创建更新时,
 * 记录更新数据的时间.
 *
 * PHP version 5.5
 *
 * @category app\components
 * @package  app\components
 * @author   zhaoyan <1210965963@qq.com>
 * @license  http://www.168helps.com License
 * @link     https://github.com/3032441712/hr
 */
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
