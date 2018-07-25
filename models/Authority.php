<?php

namespace app\models;

use Yii;


class Authority extends \yii\base\Model
{
	public $role;
	public $name;
	public $parent;
	public $child;

	/**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role'], 'string', 'max' => 16],
        ];
    }
    public function attributeLabels(){
    	return [
    		'role' => '角色',
    	];
    }

	// 创建角色
	public static function createRole($name){
	    $auth = Yii::$app->authManager;
	    $role = $auth->createRole($name);
	    $role->description = '创建了 ' . $name. ' 角色';
	    $auth->add($role);
	}

	// 创建权限
	public static function createPermission($name){
		$auth = Yii::$app->authManager;
		$createPost = $auth->createPermission($name);
		$createPost->description = '创建了 ' . $name. ' 权限';
		$auth->add($createPost);
	}

	// 将权限付给角色
	public static function assign($roleName, $userid)
    {
    	echo $roleName . '<br />';
    	echo $userid . '<br />';
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($roleName);                //创建角色对象
        $auth->assign($role, $userid);                           //添加对应关系
    }
	public static function checkAccess($userid, $roleName){
		$auth = Yii::$app->authManager;
		return $auth->checkAccess($userid, $roleName);
	}
	public static function getRoles(){
		$auth = Yii::$app->authManager;
		return $auth->getRoles();
	}

}
