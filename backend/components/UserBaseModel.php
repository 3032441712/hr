<?php
/**
 * 用户公用字段基础类
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

use Yii;
use backend\models\User;
use yii\helpers\ArrayHelper;
use app\models\HrDept;
use backend\models\HrDeptStation;
/**
 * 用户公用字段基础类
 *
 * PHP version 5.5
 *
 * @category app\components
 * @package  app\components
 * @author   zhaoyan <1210965963@qq.com>
 * @license  http://www.168helps.com License
 * @link     https://github.com/3032441712/hr
 */
class UserBaseModel extends DateTimeModel
{
    const STATUS_DELETED = -1;
    
    const STATUS_INACTIVE = 0;
    
    const STATUS_ACTIVE = 1;
    
    const ROLE_USER = 10;
    
    /**
     * 用户密码
     * 
     * @var string
     */
    public $password;
    
    /**
     * 重复输入密码
     * 
     * @var string
     */
    public $repassword;
    
    /**
     * 角色名称
     * 
     * @var string
     */
    private $_roleLabel;
    
    /**
     * 部门名称
     * 
     * @var string
     */
    private $_deptLabel;
    
    /**
     * 状态名称
     * 
     * @var string
     */
    private $_statusLabel;
    
    /**
     * 婚姻状态
     * 
     * @var string
     */
    private $_maritalStatusLabel;
    
    /**
     * 性别
     * 
     * @var string
     */
    private $_sexLabel;
    
    /**
     * 工作状态
     * 
     * @var string
     */
    private $_workingStatusLabel;
    
    /**
     * 工作类型
     * 
     * @var string
     */
    private $_jobTypeLabel;
    
    /**
     * 岗位名称
     * 
     * @var string
     */
    private $_jobStationLabel;
    
    /**
     * 岗位级别
     * 
     * @var string
     */
    private $_jobLevelLabel;
    
    /**
     * 考勤类型
     * 
     * @var string
     */
    private $_attendanceTypeLabel;
    
    /**
     * 视图中来获取员工的账号状态
     * 
     * @return string
     */
    public function getStatusLabel()
    {
        if ($this->_statusLabel == null) {
            $statusLabel = User::getArrayStatus();
            $this->_statusLabel = $statusLabel[$this->status];
        }
    
        return $this->_statusLabel;
    }
    
    /**
     * 视图中用来获取员工的婚姻状态
     * 
     * @return string
     */
    public function getMaritalStatusLabel()
    {
        if ($this->_maritalStatusLabel == null) {
            $maritalStatusLabel = User::getArrayMaritalStatus();
            $this->_maritalStatusLabel = $maritalStatusLabel[$this->marital_status];
        }
    
        return $this->_maritalStatusLabel;
    }
    
    /**
     * 视图中用来获取用户的性别
     * 
     * @return string
     */
    public function getSexLabel()
    {
        if ($this->_sexLabel == null) {
            $sexLabel = User::getArraySex();
            $this->_sexLabel = $sexLabel[$this->sex];
        }
    
        return $this->_sexLabel;
    }
    
    /**
     * 视图中获取员工的在职状态
     * 
     * @return string
     */
    public function getWorkingStatusLabel()
    {
        if ($this->_workingStatusLabel == null) {
            $workingStatusLabel = User::getArrayWorkingStatus();
            $this->_workingStatusLabel = $workingStatusLabel[$this->working_status];
        }
    
        return $this->_workingStatusLabel;
    }
    
    /**
     * 视图中获取员工的类型
     * 
     * @return string
     */
    public function getJobTypeLabel()
    {
        if ($this->_jobTypeLabel == null) {
            $jobTypeLabel = User::getArrayJobType();
            $this->_jobTypeLabel = $jobTypeLabel[$this->job_type];
        }
    
        return $this->_jobTypeLabel;
    }
    
    /**
     * 视图中获取员工的岗位信息
     * 
     * @return string
     */
    public function getJobStationLabel()
    {
        if ($this->_jobStationLabel == null) {
            $jobStationLabel = User::getArrayJobStation($this->dept_id);
            $this->_jobStationLabel = isset($jobStationLabel[$this->job_station]) ? $jobStationLabel[$this->job_station] : '暂无';
        }
    
        return $this->_jobStationLabel;
    }
    
    /**
     * 视图中获取职称级别
     * 
     * @return string
     */
    public function getJobLevelLabel()
    {
        if ($this->_jobLevelLabel == null) {
            $jobLevelLabel = User::getArrayJobLevel();
            $this->_jobLevelLabel = $jobLevelLabel[$this->job_level];
        }
    
        return $this->_jobLevelLabel;
    }
    
    /**
     * 视图中获取员工相关考勤的类型
     * 
     * @return string
     */
    public function getAttendanceTypeLabel()
    {
        if ($this->_attendanceTypeLabel == null) {
            $attendanceTypeLabel = User::getArrayAttendanceType();
            $this->_attendanceTypeLabel = $attendanceTypeLabel[$this->attendance_type];
        }
    
        return $this->_attendanceTypeLabel;
    }
    
    /**
     * 获取员工状态的数组
     * 
     * @return array
     */
    public static function getArrayStatus()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'STATUS_ACTIVE'),
            self::STATUS_INACTIVE => Yii::t('app', 'STATUS_INACTIVE'),
            self::STATUS_DELETED => Yii::t('app', 'STATUS_DELETED'),
        ];
    }
    
    /**
     * 获取员工相关的角色数组
     * 
     * @return array
     */
    public static function getArrayRole()
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
    }
    
    /**
     * 视图中获取角色名称
     * 
     * @return string
     */
    public function getRoleLabel()
    {
    
        if ($this->_roleLabel === null) {
            $roles = self::getArrayRole();
            $this->_roleLabel = $roles[$this->role];
        }
        return $this->_roleLabel;
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
    
    /**
     * 获取某个部门的员工数据
     * 
     * @param integer $deptId 部门ID
     * 
     * @return array
     */
    public static function getArrayUser($deptId)
    {
        return ArrayHelper::map(self::find()->select('id, real_name')->onCondition('id <> 1 AND dept_id = '.$deptId)->asArray()->all(), 'id', 'real_name');
    }
    
    /**
     * 视图中获取员工相关的部门名称
     * 
     * @return string
     */
    public function getDeptLabel()
    {
        if ($this->_deptLabel == null) {
            $dept = HrDept::getArrayDept();
            $this->_deptLabel = $dept[$this->dept_id];
        }
    
        return $this->_deptLabel;
    }
    
    /**
     * 获取员工的所有婚姻状态列表
     * 
     * @return array
     */
    public static function getArrayMaritalStatus()
    {
        return [
            0 => '请选择',
            1 => '未婚',
            2 => '已婚',
            3 => '离异',
            4 => '丧偶'
        ];
    }
    
    /**
     * 获取员工的所有在职状态
     * 
     * @return array
     */
    public static function getArrayWorkingStatus()
    {
        return [
            0 => '请选择',
            1 => '在职',
            2 => '辞职',
            3 => '离休'
        ];
    }
    
    /**
     * 获取所有的员工职称级别
     * 
     * @return array
     */    
    public static function getArrayJobLevel()
    {
        return [
            0 => '请选择',
            1 => '初级',
            2 => '中级',
            3 => '高级',
            4 => '专家'
        ];
    }
    
    /**
     * 获取员工类型列表
     * 
     * @return array
     */
    public static function getArrayJobType()
    {
        return [
            0 => '请选择',
            1 => '临时工',
            2 => '实习生',
            3 => '正式员工'
        ];
    }
    
    /**
     * 获取所有的考勤类型
     * 
     * @return array
     */
    public static function getArrayAttendanceType()
    {
        return [
            0 => '请选择',
            1 => '正常班',
            2 => '轮班制',
            3 => '执行班'
        ];
    }
    
    /**
     * 获取某个部门下的所有工作岗位
     * 
     * @param integer $deptId 部门ID
     * 
     * @return array
     */
    public static function getArrayJobStation($deptId)
    {
        $data = [0 => '请选择'];
        if (empty($deptId)) {
            $deptId = 2;
        }
        $data = HrDeptStation::find()->onCondition(['dept_id' => $deptId])->select('id, title')->asArray()->all();

        return ArrayHelper::map($data, 'id', 'title');
    }
}