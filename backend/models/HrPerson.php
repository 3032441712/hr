<?php

namespace backend\models;

use Yii;
use app\components\DateTimeModel;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $dept_id
 * @property string $job_number
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
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class HrPerson extends DateTimeModel
{
    public $password;

    public $repassword;
    
    private $_statusLabel;
    
    private $_maritalStatusLabel;
    
    private $_sexLabel;
    
    private $_workingStatusLabel;
    
    private $_jobTypeLabel;
    
    private $_jobStationLabel;
    
    private $_jobLevelLabel;
    
    private $_attendanceTypeLabel;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dept_id', 'job_number', 'sex', 'marital_status', 'country', 'province', 'city', 'district', 'working_status', 'job_type', 'job_station', 'job_level', 'attendance_type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['real_name', 'birthday', 'entry_time', 'salary_time', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['birthday', 'last_login', 'entry_time', 'salary_time'], 'safe'],
            [['real_name', 'role'], 'string', 'max' => 64],
            [['last_ip'], 'string', 'max' => 15],
            [['address', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['real_name', 'email', 'password', 'repassword', 'address', 'zipcode', 'qq', 'office_phone', 'home_phone', 'mobile_phone'], 'trim'],
            [['password', 'repassword'], 'string', 'min' => 6, 'max' => 30],
            [['zipcode'], 'string', 'max' => 60],
            [['qq', 'office_phone', 'home_phone', 'mobile_phone'], 'string', 'max' => 20],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'unique'],
        ];
    }
    
    /**
     * 允许用户更新的数据字段
     * 
     * @return array
     */
    public function scenarios()
    {
        return [
            'user-update' => [
                'real_name', 'sex', 'marital_status', 'birthday', 'email', 'password', 'repassword', 'province', 'city', 'district',
                'address', 'zipcode', 'qq', 'office_phone', 'home_phone', 'mobile_phone'
            ]
        ];
    }
    
    public function getStatusLabel()
    {
        if ($this->_statusLabel == null) {
            $statusLabel = User::getArrayStatus();
            $this->_statusLabel = $statusLabel[$this->status];
        }
        
        return $this->_statusLabel;
    }
    
    public function getMaritalStatusLabel()
    {
        if ($this->_maritalStatusLabel == null) {
            $maritalStatusLabel = User::getArrayMaritalStatus();
            $this->_maritalStatusLabel = $maritalStatusLabel[$this->marital_status];
        }
        
        return $this->_maritalStatusLabel;
    }
    
    public function getSexLabel()
    {
        if ($this->_sexLabel == null) {
            $sexLabel = User::getArraySex();
            $this->_sexLabel = $sexLabel[$this->sex];
        }
        
        return $this->_sexLabel;
    }
    
    public function getWorkingStatusLabel()
    {
        if ($this->_workingStatusLabel == null) {
            $workingStatusLabel = User::getArrayWorkingStatus();
            $this->_workingStatusLabel = $workingStatusLabel[$this->working_status];
        }
        
        return $this->_workingStatusLabel;
    }
    
    public function getJobTypeLabel()
    {
        if ($this->_jobTypeLabel == null) {
            $jobTypeLabel = User::getArrayJobType();
            $this->_jobTypeLabel = $jobTypeLabel[$this->job_type];
        }
        
        return $this->_jobTypeLabel;
    }
    
    public function getJobStationLabel()
    {
        if ($this->_jobStationLabel == null) {
            $jobStationLabel = User::getArrayJobStation($this->dept_id);
            $this->_jobStationLabel = $jobStationLabel[$this->job_station];
        }
        
        return $this->_jobStationLabel;
    }
    
    public function getJobLevelLabel()
    {
        if ($this->_jobLevelLabel == null) {
            $jobLevelLabel = User::getArrayJobLevel();
            $this->_jobLevelLabel = $jobLevelLabel[$this->job_level];
        }
        
        return $this->_jobLevelLabel;
    }
    
    public function getAttendanceTypeLabel()
    {
        if ($this->_attendanceTypeLabel == null) {
            $attendanceTypeLabel = User::getArrayAttendanceType();
            $this->_attendanceTypeLabel = $attendanceTypeLabel[$this->attendance_type];
        }
        
        return $this->_attendanceTypeLabel;
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dept_id' => '部门',
            'job_number' => '员工工号',
            'real_name' => 'Real Name',
            'sex' => '性别',
            'birthday' => '生日',
            'marital_status' => '婚姻状况',
            'last_login' => '上次登陆时间',
            'last_ip' => '上次登录的IP地址',
            'country' => '国家',
            'province' => '省份',
            'city' => '城市',
            'district' => '区域',
            'address' => '地址',
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
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'role' => 'Role',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

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
