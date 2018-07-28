<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category_user".
 *
 * @property int $categoryid
 * @property int $userid
 */
class CategoryUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_user';
    }

	// 设置某用户都某些文章分类有权限
    public static function set($userid, $categoryids){
		CategoryUser::deleteAll('userid = ' . $userid);
		foreach($categoryids as $cids){
			$cu = new CategoryUser();
			$cu->userid = $userid;
			$cu->categoryid = $cids;
			$cu->save();
		}
    }
	// 读取某用户的所有文章分类权限
    public static function get($userid){
    	$cates = CategoryUser::find()->where('userid=' . $userid)->all();
    	return ArrayHelper::map($cates, 'categoryid', 'categoryid');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoryid', 'userid'], 'required'],
            [['categoryid', 'userid'], 'integer'],
            [['categoryid', 'userid'], 'unique', 'targetAttribute' => ['categoryid', 'userid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'categoryid' => 'Categoryid',
            'userid' => 'Userid',
        ];
    }
}
