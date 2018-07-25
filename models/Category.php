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
 * @property int $outsite 是否外部链接
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
	public static function add($nameOrUrl, $fatherid){
		$cate = Category::find()->where("name ='" . $nameOrUrl . "' or url='" . $nameOrUrl . "'")->one();
		if($cate){
			Yii::$app->session->setFlash("message", "该分类已经存在");
			return;
		}
		$cate = new Category();
		$cate->fatherid = $fatherid;
		if(strpos($nameOrUrl, '/') === false){
			$cate->name = $nameOrUrl;
		}
		else{
			$cate->url = $nameOrUrl;
		}
		$cate->save();
		return $cate;
	}
	public static function getAll(){
		return self::find()->where('id>=0')->all();
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fatherid'], 'required'],
            [['fatherid', 'outsite'], 'integer'],
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
            'outsite' => 'Outsite',
        ];
    }
}
