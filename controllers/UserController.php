<?php

namespace app\controllers;

use Yii;
use app\models\User;

class UserController extends \yii\rest\ActiveController
{
	public $modelClass = 'app\models\User';

    /**
     * @return \yii\web\Response
     */
    public function actionLogin(string $username, string $password)
    {
    	$user = User::findByUsername($username);

    	if ($user && $user->validatePassword($password)) {
            $token = User::generateToken($user);

	    	return $this->asJson([
	    		'status' => true, 
                'message' => 'Success', 
	            'token' => $token, 
	        ]);
        }

        return [
            'status' => false,
            'message' => 'Wrong username or password'
        ];
    }
}
