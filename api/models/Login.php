<?php
namespace api\models;

use common\models\Users;
use yii\base\Model;

class Login extends Model
{
	public $login;
	public $password;
	private $_user = false;
	
	public function rules()
	{
		return [
				// username and password are both required
				[['login', 'password'], 'required'],
				// rememberMe must be a boolean value
				// password is validated by validatePassword()
				['password', 'validatePassword'],
		];
	}
	public function login()
	{
		if ($this->validate()) {
			return $this->_user;
		}
		return false;
	}
	public function validatePassword($attribute, $params)
	{
		if (!$this->hasErrors()) {
			$user = $this->getUser();
	
			if (!$user || !$user->validatePassword($this->password)) {
				$this->addError($attribute, 'Incorrect login or password');
			}
		}
	}
	public function getUser()
	{
		if ($this->_user === false) {
			$this->_user = Users::findOne(['user_login'=>$this->login]);
		}
	
		return $this->_user;
	}
	
	
}