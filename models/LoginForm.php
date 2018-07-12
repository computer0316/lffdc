<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $mobile;
    public $smsCode;
    public $verifyCode;
    public $password;
    public $password1;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['mobile', 'verifyCode'], 'required', 'on' => 'register1'],
            [['mobile'], 'string', 'length' => [11,11]],
            [['mobile', 'password', 'passwordCompare', 'smsCode'], 'required', 'on' => 'register2'],
            [['smsCode', 'password', 'passwordCompare'], 'string'],
            ['passwordCompare', 'compare', 'compareAttribute' => 'password'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser());
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->mobile);
        }

        return $this->_user;
    }

    public function scenarios()
    {
    	$scenarios = parent::scenarios();
    	$scenarios['login'] = ['mobile', 'password'];
        $scenarios['register1'] = ['mobile', 'verifyCode'];
        $scenarios['register2'] = ['smsCode', 'password', 'passwordCompare', 'mobile'];
        return $scenarios;
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mobile'		=> '手机号',
            'smsCode'		=> '短信验证码',
            'verifyCode'	=> '验证码',
            'password'	=> '密码',
            'passwordCompare'	=> '确认密码',
        ];
    }

}
