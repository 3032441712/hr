<?php
namespace backend\models;

use Yii;
use app\models\HrLog;

/**
 * User model
 *
 * @property integer $id
 * @property integer $dept_id
 * @property string $real_name
 * @property integer $sex
 * @property string $birthday
 * @property integer $marital_status
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
 * @property string $entry_time
 * @property string $salary_time
 * @property integer $working_status
 * @property integer $job_type
 * @property integer $job_station
 * @property integer $job_level
 * @property integer $attendance_type
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

    /**
      * @inheritdoc
      */
    public function rules()
    {
        return [
            [['birthday', 'email', 'entry_time', 'salary_time'], 'required'],
            [['dept_id', 'job_number', 'sex', 'country', 'province', 'city', 'district', 'marital_status', 'working_status', 'job_type', 'job_station', 'job_level', 'attendance_type'], 'integer'],
            [['birthday', 'last_login', 'entry_time', 'salary_time'], 'safe'],
            [['last_ip', 'qq', 'office_phone', 'home_phone', 'mobile_phone', 'marital_status'], 'string', 'max' => 20],
            [['zipcode'], 'string', 'max' => 60],
            ['address', 'string', 'max' => 255],
            [['password', 'repassword'], 'required', 'on' => ['admin-create']],
            [['real_name', 'email', 'password', 'repassword', 'address', 'zipcode', 'qq', 'office_phone', 'home_phone', 'mobile_phone'], 'trim'],
            [['password', 'repassword'], 'string', 'min' => 6, 'max' => 30],
            // Unique
            [['email', 'job_number'], 'unique'],
            // RealName
            ['real_name', 'string', 'min' => 2, 'max' => 30],
            // E-mail
            ['email', 'string', 'max' => 100],
            ['email', 'email'],
            // Repassword
            ['repassword', 'compare', 'compareAttribute' => 'password'],
            //['status', 'default', 'value' => static::STATUS_ACTIVE],
            ['status', 'in', 'range' => [static::STATUS_ACTIVE, static::STATUS_INACTIVE, static::STATUS_DELETED]],

            // Status
            ['role', 'in', 'range' => array_keys(static::getArrayRole())],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'admin-create' => [
                'real_name', 'job_number', 'marital_status', 'birthday', 'email', 'password', 'repassword', 'status', 'role',
                'sex', 'last_login', 'last_ip', 'country', 'province', 'city', 'district', 'dept_id',
                'address', 'zipcode', 'qq', 'office_phone', 'home_phone', 'mobile_phone', 'working_status', 
                'job_type', 'job_station', 'job_level', 'attendance_type', 'entry_time', 'salary_time'
            ],
            'admin-update' => [
                'real_name', 'job_number', 'marital_status', 'birthday', 'email', 'password', 'repassword', 'status', 'role',
                'sex', 'last_login', 'last_ip', 'country', 'province', 'city', 'district', 'dept_id',
                'address', 'zipcode', 'qq', 'office_phone', 'home_phone', 'mobile_phone', 'working_status', 
                'job_type', 'job_station', 'job_level', 'attendance_type', 'entry_time', 'salary_time'
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
                'job_number' => '员工工号',
                'password' => Yii::t('app', 'Password'),
                'repassword' => Yii::t('app', 'Repassword'),
                'dept_id' => '部门',
                'sex' => '性别',
                'birthday' => '生日',
                'marital_status' => '婚姻状况',
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
                'entry_time' => '入职时间',
                'salary_time' => '起薪时间',
                'working_status' => '在职状态',
                'job_type' => '员工类型',
                'job_station' => '员工岗位',
                'job_level' => '职称级别',
                'attendance_type' => '考勤类型',
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $time = time();
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || (!$this->isNewRecord && $this->password)) {
                $this->setPassword($this->password);
                $this->generateAuthKey();
                $this->generatePasswordResetToken();
            }

            if ($this->isNewRecord) {
                $this->created_at = $time;
            }
            
            $this->updated_at = $time;
            return true;
        }
        return false;
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
            $content = '新增用户: '.$this->real_name.'('.$this->id.')';
        } else {
            $content = '编辑用户: '.$this->real_name.'('.$this->id.'), 修改前数据:'.json_encode($changedAttributes);
        }

        HrLog::saveSystemLog(HrLog::USER_ACTION, $content);
        parent::afterSave($insert, $changedAttributes);
    }
}
