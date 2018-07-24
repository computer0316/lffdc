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
	public static function addChild($parent, $child)
    {
        $auth = Yii::$app->authManager;
        $parent = $auth->createRole($items['role']);                //创建角色对象
        $child = $auth->createPermission($items['permission']);     //创建权限对象
        $auth->addChild($parent, $child);                           //添加对应关系
    }

	public static function getRoles(){
		$auth = Yii::$app->authManager;
		return $auth->getRoles();
	}

}
