<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $name
 * @property int $fatherid
 * @property string $url 外部链接地址
 * @property int $addmenu 是否在导航菜单上显示
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

	/*
	 * 添加文章分类
	 * $nameOrUrl 可以是分类名称，如果外部连接，则直接填写外部连接的 url
	 * $fatherid 父分类ID
	 */
	public static function add($category){
		$condition = "(name ='" . $category->name . "' and fatherid = " . $category->fatherid . ')';
		if(!empty($category->url)){
			$condition = $condition . " or url='" . $category->url . "'";
		}
		$cateTemp = Category::find()->where($condition)->one();
		if($cateTemp){
			Yii::$app->session->setFlash("message", "该分类已经存在");
			return;
		}

		$category->save();
		return $category;
	}
	public static function getAll(){
		return self::find()->where('id>=0')->all();
	}

	public static function getAllSons($id){

	}

	private static function getSon($id){
		self::find()->where('fatherid = ' . $id)->all();
	}
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fatherid', 'name'], 'required'],
            [['fatherid', 'addmenu'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['url'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'fatherid' => 'Fatherid',
            'url' => 'Url',
            'addmenu' => 'addmenu',
        ];
    }
}
