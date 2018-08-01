<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category_article".
 *
 * @property int $categoryid
 * @property int $articleid
 */
class CategoryArticle extends \yii\db\ActiveRecord
{
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
            [['categoryid', 'articleid'], 'required'],
            [['categoryid', 'articleid'], 'integer'],
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
        ];
    }
}
