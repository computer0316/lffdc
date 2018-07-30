<?php

namespace app\models;

use Yii;
use app\models\CategoryUser;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $mobile
 * @property string $password
 * @property string $firsttime
 * @property string $updatetime
 * @property string $ip
 * @property int $admin
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    public function getCategories(){
    	return $this->hasMany(CategoryUser::className(), ['userid' => 'id']);
    }

    /*
    */
	public static function register($loginForm){
		$user = self::find()->where(['mobile'	=> $loginForm->mobile])->one();
		if($user){
			Yii::$app->session->set('userid', $user->id);
			$user->updatetime	= date("Y-m-d H:i:s", time());
			$user->ip			= Yii::$app->request->userIP;
			$user->save();
			return $user;
		}
		else{
			$user = new User();
			$user->name			= $loginForm->mobile;
			$user->password		= md5($loginForm->password);
			$user->mobile 		= $loginForm->mobile;
			$user->firsttime 	= date("Y-m-d H:i:s", time());
			$user->updatetime	= date("Y-m-d H:i:s", time());
			$user->ip			= Yii::$app->request->userIP;
			$user->save();
			Yii::$app->session->set('userid', $user->id);
			return $user;
		}
	}

		// 检查手机号是否注册
	public static function checkMobile($mobile){
		return User::find()->where(['mobile' => $mobile])->one();
	}

	public function changePassword($userLoad){
		if($this->password != md5($userLoad->password)){
			throw new Exception('原始密码不对');
		}
		if($userLoad->password1 == $userLoad->password2){
			$this->password = md5($userLoad->password1);
			if($this->save()){
				return true;
			}
			else{
				throw new Exception('新密码保存失败');
			}
		}
		else{
			throw new Exception('两次输入不一致');
		}
	}

	public static function findIdentity($id){
		return static::findOne($id);
	}

	/**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($name)
    {
        return static::find()->where(['name' => $name])->one();
    }

    /**
     * Finds user by mobile
     *
     * @param string $mobile
     * @return static|null
     */
    public static function findByMobile($mobile)
    {
        return static::find()->where(['mobile' => $mobile])->one();
    }

    public function getId(){
    	return $this->id;
    }

	public function getAuthKey(){
	}

	/**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {

    }

	public function validatePassword($password){
		return $this->password === md5($password);
	}

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'mobile', 'password', 'ip'], 'required'],
            [['firsttime', 'updatetime'], 'safe'],
            [['admin'], 'integer'],
            [['name', 'mobile'], 'string', 'max' => 16],
            [['password'], 'string', 'max' => 64],
            [['ip'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'mobile' => '手机号',
            'password' => '密码',
            'firsttime' => '首次登录',
            'updatetime' => '最后登录',
            'ip' => 'Ip',
            'admin' => 'Admin',
        ];
    }
}
