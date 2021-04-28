<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class CreateUser extends Model
{
	public $username;
	public $email;
	public $password;

	public $role;

	/**
	 * {@inheritdoc}
	 */
	public function rules()
	{
		return [
			['role', 'trim'],
			['role', 'required'],

			['username', 'trim'],
			['username', 'required'],
			['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
			['username', 'string', 'min' => 2, 'max' => 255],

			['email', 'trim'],
			['email', 'required'],
			['email', 'email'],
			['email', 'string', 'max' => 255],
			['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

			['password', 'required'],
			['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
		];
	}

	/**
	 * Signs user up.
	 *
	 * @return bool whether the creating new account was successful and email was sent
	 */
	public function signup()
	{
		if (!$this->validate()) {
			return null;
		}

		$user = new User();
		$user->username = $this->username;
		$user->email = $this->email;
		$user->status = $user::STATUS_ACTIVE;
		$user->role = $this->role;
		$user->rbac = $user::ADMIN_LOGIN;
		$user->setPassword($this->password);
		$user->generateAuthKey();

		//TODO send email to created user
		return $user->save();
	}
}
