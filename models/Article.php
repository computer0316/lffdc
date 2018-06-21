<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title_before
 * @property string $title
 * @property string $title_after
 * @property string $number 文号
 * @property string $text
 * @property int $department 发布部门
 * @property int $creater 发布人
 * @property string $updatetime
 * @property int $times
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'department', 'creater', 'updatetime', 'times'], 'required'],
            [['text'], 'string'],
            [['department', 'creater', 'times'], 'integer'],
            [['updatetime'], 'safe'],
            [['title_before', 'title', 'title_after'], 'string', 'max' => 128],
            [['number'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title_before' => 'Title Before',
            'title' => 'Title',
            'title_after' => 'Title After',
            'number' => 'Number',
            'text' => 'Text',
            'department' => 'Department',
            'creater' => 'Creater',
            'updatetime' => 'Updatetime',
            'times' => 'Times',
        ];
    }
}
