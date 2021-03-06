<?php
/**
 * 系统公告数据处理模块
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
use app\components\DateTimeModel;

/**
 * This is the model class for table "hr_notice".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class HrNotice extends DateTimeModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hr_notice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['status'], 'integer'],
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
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }
    
    /**
     * 获取最后发表的系统公告
     * 
     * @return mixed
     */
    public static function getLastNoticeArray()
    {
        return static::find()->orderBy('id DESC')->limit('1')->asArray()->one();
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
            $content = '新增公告: '.$this->title.'('.$this->id.')';
        } else {
            $content = '编辑公告 '.$this->title.'('.$this->id.'), 修改前数据:'.json_encode($changedAttributes);
        }
    
        HrLog::saveSystemLog(HrLog::NOTICE_ACTION, $content);
        parent::afterSave($insert, $changedAttributes);
    }
}