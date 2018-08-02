<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "data".
 *
 * @property string $id
 * @property int $classid
 * @property string $writer
 * @property string $befrom
 * @property string $newstext
 * @property string $keyid
 * @property int $dokey
 * @property int $newstempid
 * @property int $closepl
 * @property int $haveaddfen
 * @property string $infotags
 */
class Data extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'newstext'], 'required'],
            [['id', 'classid', 'dokey', 'newstempid', 'closepl', 'haveaddfen'], 'integer'],
            [['newstext'], 'string'],
            [['writer'], 'string', 'max' => 30],
            [['befrom'], 'string', 'max' => 60],
            [['keyid'], 'string', 'max' => 255],
            [['infotags'], 'string', 'max' => 80],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'classid' => 'Classid',
            'writer' => 'Writer',
            'befrom' => 'Befrom',
            'newstext' => 'Newstext',
            'keyid' => 'Keyid',
            'dokey' => 'Dokey',
            'newstempid' => 'Newstempid',
            'closepl' => 'Closepl',
            'haveaddfen' => 'Haveaddfen',
            'infotags' => 'Infotags',
        ];
    }
}
