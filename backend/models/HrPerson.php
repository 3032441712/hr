<?php
/**
 * 用户个人信息处理模块
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
namespace backend\models;

use Yii;

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
class HrPerson extends User
{    
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
            ],
            'user-update-pass' => [
                'password', 'repassword'
            ]
        ];
    }
}
