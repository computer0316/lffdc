<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_article".
 *
 * @property int $categoryid
 * @property int $articleid
 * @property string $updatetime
 */
class CategoryArticle extends \yii\db\ActiveRecord
{
	/*
	 * 如果一篇文章属于多个分类，则返回所有分类的ID
	 */
	public static function getCategories($articleid){
		$categories = self::find()->where('articleid = ' . $articleid)->all();
		return ArrayHelper::getValue($categories, 'CategoryArticle.categoryid');
	}

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoryid', 'articleid', 'updatetime'], 'required'],
            [['categoryid', 'articleid'], 'integer'],
            [['updatetime'], 'safe'],
            [['categoryid', 'articleid'], 'unique', 'targetAttribute' => ['categoryid', 'articleid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'categoryid' => 'Categoryid',
            'articleid' => 'Articleid',
            'updatetime' => 'Updatetime',
        ];
    }
}
