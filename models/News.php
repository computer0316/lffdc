<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property string $id
 * @property int $classid
 * @property string $onclick
 * @property string $newspath
 * @property string $keyboard
 * @property string $userid
 * @property string $username
 * @property int $istop
 * @property string $truetime
 * @property int $ismember
 * @property int $userfen
 * @property int $isgood
 * @property string $titlefont
 * @property string $titleurl
 * @property string $filename
 * @property int $groupid
 * @property string $plnum
 * @property int $firsttitle
 * @property int $isqf
 * @property string $totaldown
 * @property string $title
 * @property string $newstime
 * @property string $titlepic
 * @property int $havehtml
 * @property string $lastdotime
 * @property int $infopfen
 * @property int $infopfennum
 * @property string $ftitle
 * @property string $smalltext
 * @property int $diggtop
 * @property int $stb
 * @property int $ttid
 * @property int $ispic
 * @property int $isurl
 * @property int $fstb
 * @property int $restb
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['classid', 'onclick', 'userid', 'istop', 'truetime', 'ismember', 'userfen', 'isgood', 'groupid', 'plnum', 'firsttitle', 'isqf', 'totaldown', 'newstime', 'havehtml', 'lastdotime', 'infopfen', 'infopfennum', 'diggtop', 'stb', 'ttid', 'ispic', 'isurl', 'fstb', 'restb'], 'integer'],
            [['newspath', 'username'], 'string', 'max' => 20],
            [['keyboard'], 'string', 'max' => 80],
            [['titlefont'], 'string', 'max' => 14],
            [['titleurl'], 'string', 'max' => 200],
            [['filename'], 'string', 'max' => 36],
            [['title'], 'string', 'max' => 100],
            [['titlepic', 'ftitle'], 'string', 'max' => 120],
            [['smalltext'], 'string', 'max' => 255],
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
            'onclick' => 'Onclick',
            'newspath' => 'Newspath',
            'keyboard' => 'Keyboard',
            'userid' => 'Userid',
            'username' => 'Username',
            'istop' => 'Istop',
            'truetime' => 'Truetime',
            'ismember' => 'Ismember',
            'userfen' => 'Userfen',
            'isgood' => 'Isgood',
            'titlefont' => 'Titlefont',
            'titleurl' => 'Titleurl',
            'filename' => 'Filename',
            'groupid' => 'Groupid',
            'plnum' => 'Plnum',
            'firsttitle' => 'Firsttitle',
            'isqf' => 'Isqf',
            'totaldown' => 'Totaldown',
            'title' => 'Title',
            'newstime' => 'Newstime',
            'titlepic' => 'Titlepic',
            'havehtml' => 'Havehtml',
            'lastdotime' => 'Lastdotime',
            'infopfen' => 'Infopfen',
            'infopfennum' => 'Infopfennum',
            'ftitle' => 'Ftitle',
            'smalltext' => 'Smalltext',
            'diggtop' => 'Diggtop',
            'stb' => 'Stb',
            'ttid' => 'Ttid',
            'ispic' => 'Ispic',
            'isurl' => 'Isurl',
            'fstb' => 'Fstb',
            'restb' => 'Restb',
        ];
    }
}
