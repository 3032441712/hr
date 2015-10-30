<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "accounts".
 *
 * @property integer $account_id
 * @property string $account_title
 * @property integer $account_cat
 * @property string $account_content
 * @property integer $user_id
 * @property integer $acount_status
 * @property string $createtime
 * @property string $updated
 */
class Accounts extends \yii\db\ActiveRecord
{
    private $_categoryLabel;

    private $_userLabel;

    private $_statusLabel;
    
    private $_encryptHelper;

    public static function getArrayCategory()
    {
        return ArrayHelper::map(AccountCategory::find()->asArray()->all(), 'cat_id', 'cat_title');
    }

    public static function getArrayUser()
    {
        return ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username');
    }

    public static function getArrayStatus()
    {
        return [
            '0' => '禁用',
            '1' => '启用'
        ];
    }

    public function getCategoryLabel()
    {
        if ($this->_categoryLabel === null) {
            $categorys = self::getArrayCategory();
            $this->_categoryLabel = $categorys[$this->account_cat];
        }

        return $this->_categoryLabel;
    }

    public function getUserLabel()
    {
        if ($this->_userLabel === null) {
            $categorys = self::getArrayUser();
            $this->_userLabel = $categorys[$this->user_id];
        }

        return $this->_userLabel;
    }

    public function getStatusLabel()
    {
        if ($this->_statusLabel === null) {
            $categorys = self::getArrayStatus();
            $this->_statusLabel = $categorys[$this->acount_status];
        }

        return $this->_statusLabel;
    }

    public function getContentLabel()
    {
        if ($this->_encryptHelper === null) {
            $this->_encryptHelper = new \common\helpers\EncryptHelper(Yii::$app->params['account_secret_key']);
        }

        return nl2br($this->_encryptHelper->decode($this->account_content));
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_cat', 'user_id', 'acount_status'], 'integer'],
            [['account_content', 'createtime'], 'required'],
            [['account_content'], 'string'],
            [['createtime', 'updated'], 'safe'],
            [['account_title'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'account_id' => '主键ID',
            'account_title' => '帐号标题',
            'account_cat' => '分类',
            'account_content' => '内容',
            'user_id' => '用户ID',
            'acount_status' => '帐号状态',
            'createtime' => '创建时间',
            'updated' => 'Updated',
        ];
    }
}
