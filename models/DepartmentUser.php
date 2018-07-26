<?php

namespace app\models;

use Yii;

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
