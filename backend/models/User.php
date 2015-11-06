<?php
namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\HrDept;

/**
 * User model
 *
 * @property integer $id
 * @property integer $dept_id
 * @property string $real_name
 * @property integer $sex
 * @property string $birthday
 * @property string $last_login
 * @property string $last_ip
 * @property integer $country
 * @property integer $province
 * @property integer $city
 * @property integer $district
 * @property string $address
 * @property string $zipcode
 * @property string $qq
 * @property string $office_phone
 * @property string $home_phone
 * @property string $mobile_phone
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends \common\models\User
{
    public $password;
    public $repassword;
    private $_statusLabel;
    private $_roleLabel;
    private $_sexLabel;
    private $_deptLabel;

    /**
     * @inheritdoc
     */
    public function getStatusLabel()
    {
        if ($this->_statusLabel === null) {
            $statuses = self::getArrayStatus();
            $this->_statusLabel = $statuses[$this->status];
        }
        return $this->_statusLabel;
    }

    /**
     * @inheritdoc
     */
    public static function getArrayStatus()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'STATUS_ACTIVE'),
            self::STATUS_INACTIVE => Yii::t('app', 'STATUS_INACTIVE'),
            self::STATUS_DELETED => Yii::t('app', 'STATUS_DELETED'),
        ];
    }

    public static function getArrayRole()
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
    }

    public function getRoleLabel()
    {

        if ($this->_roleLabel === null) {
            $roles = self::getArrayRole();
            $this->_roleLabel = $roles[$this->role];
        }
        return $this->_roleLabel;
    }

    /**
     * 获取员工性别标题
     */
    public function getSexLabel()
    {
        if ($this->_sexLabel == null) {
            $sex = self::getArraySex();
            $this->_sexLabel = $sex[$this->sex];
        }

        return $this->_sexLabel;
    }

    /**
     * 获取性别
     * 
     * @return array
     */
    public static function getArraySex()
    {
        return [
            0 => '男',
            1 => '女'
        ];
    }

    public static function getArrayUser()
    {
        return ArrayHelper::map(self::find()->select('id, real_name')->onCondition('id <> 1')->asArray()->all(), 'id', 'real_name');
    }

    public function getDeptLabel()
    {
        if ($this->_deptLabel == null) {
            $dept = HrDept::getArrayDept();
            $this->_deptLabel = $dept[$this->dept_id];
        }

        return $this->_deptLabel;
    }

    /**
      * @inheritdoc
      */
    public function rules()
    {
        return [
            [['birthday', 'email'], 'required'],
            [['dept_id', 'sex', 'country', 'province', 'city', 'district'], 'integer'],
            [['birthday', 'last_login'], 'safe'],
            [['last_ip', 'qq', 'office_phone', 'home_phone', 'mobile_phone'], 'string', 'max' => 20],
            [['zipcode'], 'string', 'max' => 60],
            ['address', 'string', 'max' => 255],
            [['password', 'repassword'], 'required', 'on' => ['admin-create']],
            [['real_name', 'email', 'password', 'repassword', 'address', 'zipcode', 'qq', 'office_phone', 'home_phone', 'mobile_phone'], 'trim'],
            [['password', 'repassword'], 'string', 'min' => 6, 'max' => 30],
            // Unique
            [['email'], 'unique'],
            // RealName
            ['real_name', 'string', 'min' => 2, 'max' => 30],
            // E-mail
            ['email', 'string', 'max' => 100],
            ['email', 'email'],
            // Repassword
            ['repassword', 'compare', 'compareAttribute' => 'password'],
            //['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],

            // Status
            ['role', 'in', 'range' => array_keys(self::getArrayRole())],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'admin-create' => [
                'real_name', 'birthday', 'email', 'password', 'repassword', 'status', 'role',
                'sex', 'last_login', 'last_ip', 'country', 'province', 'city', 'district', 'dept_id',
                'address', 'zipcode', 'qq', 'office_phone', 'home_phone', 'mobile_phone'
            ],
            'admin-update' => [
                'real_name', 'birthday', 'email', 'password', 'repassword', 'status', 'role',
                'sex', 'last_login', 'last_ip', 'country', 'province', 'city', 'district', 'dept_id',
                'address', 'zipcode', 'qq', 'office_phone', 'home_phone', 'mobile_phone'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();

        return array_merge(
            $labels,
            [
                'real_name' => '姓名',
                'password' => Yii::t('app', 'Password'),
                'repassword' => Yii::t('app', 'Repassword'),
                'dept_id' => '部门',
                'sex' => '性别',
                'birthday' => '生日',
                'last_login' => '上次登陆时间',
                'last_ip' => '上次登录的IP地址',
                'country' => '国家',
                'province' => '省份',
                'city' => '城市',
                'district' => '区域',
                'address' => '户籍居住地址',
                'zipcode' => '邮政编码',
                'qq' => 'QQ',
                'office_phone' => '办公电话',
                'home_phone' => '家庭电话',
                'mobile_phone' => '手机',
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || (!$this->isNewRecord && $this->password)) {
                $this->setPassword($this->password);
                $this->generateAuthKey();
                $this->generatePasswordResetToken();
            }
            return true;
        }
        return false;
    }
}
