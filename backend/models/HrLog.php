<?php
namespace app\models;

use Yii;
use app\components\DateTimeModel;
use backend\models\User;

/**
 * This is the model class for table "{{%log}}".
 *
 * @property integer $id
 * @property string $exec_action
 * @property string $content
 * @property integer $user_id
 * @property string $ip_address
 * @property string $created_at
 * @property string $updated_at
 */
class HrLog extends DateTimeModel
{
    const LOGIN_ACTION = 'login';

    const LOGOUT_ACTION = 'logout';

    const USER_ACTION = 'user';

    const DEPT_ACTION = 'dept';

    const DEPT_STATION_ACTION = 'dept_station';

    const NOTICE_ACTION = 'notice';
    
    private $_userLabel;
    
    public function getUserLabel()
    {
        if ($this->_userLabel == null) {
            $this->_userLabel = User::findIdentity($this->user_id)->real_name;
        }

        return $this->_userLabel;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exec_action', 'content', 'user_id', 'created_at', 'updated_at'], 'required'],
            [['content'], 'string'],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['exec_action', 'ip_address'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'exec_action' => '执行的动作',
            'content' => '日志内容',
            'user_id' => '用户ID',
            'ip_address' => 'IP地址',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * 保存系统日志
     * 
     * @param string $action  执行的页面
     * @param string $content 内容
     * 
     * @return bool true/false
     */
    public static function saveSystemLog($action, $content)
    {
        $datetime = date('Y-m-d H:i:s');
        $attribute = [
            'exec_action' => $action,
            'content' => $content,
            'user_id' => Yii::$app->user->id,
            'ip_address' => Yii::$app->request->userIP,
            'created_at' => $datetime,
            'updated_at' => $datetime
        ];

        return self::getDb()->createCommand()->insert(self::tableName(), $attribute)->execute();
    }
}