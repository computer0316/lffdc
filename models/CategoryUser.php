<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Category;

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

	// ����ĳ�û���ĳЩ���·�����Ȩ��
    public static function set($userid, $categoryids){
		CategoryUser::deleteAll('userid = ' . $userid);
		foreach($categoryids as $cids){
			$cu = new CategoryUser();
			$cu->userid = $userid;
			$cu->categoryid = $cids;
			$cu->save();
		}
    }
	// ��ȡĳ�û����������·���Ȩ��
    public static function get($userid){
    	$cates = CategoryUser::find()->where('userid=' . $userid)->all();
    	return ArrayHelper::map($cates, 'categoryid', 'categoryid');
    }

    // ��ȡĳ�û����������·��࣬���ط�������
    public static function getNames($userid){
    	$cates = CategoryUser::find()->where('userid=' . $userid)->all();
    	$cates = ArrayHelper::map($cates, 'categoryid', 'categoryid');
		$categories = Category::find()->where('id in (' . implode(",", $cates) . ')')->all();
		return ArrayHelper::map($categories, 'id', 'name');
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
