<?php

namespace app\models;

use Yii;
use app\models\Department;

/**
 * This is the model class for table "department_user".
 *
 * @property int $departmentid
 * @property int $userid
 */
class DepartmentUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department_user';
    }

	public static function getUserDepartment($user){
		$du = self::find()->where('userid = ' . $user)->one();
		return Department::findOne($du->departmentid)->name;
	}
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['departmentid', 'userid'], 'required'],
            [['departmentid', 'userid'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'departmentid' => 'Departmentid',
            'userid' => 'Userid',
        ];
    }
}
