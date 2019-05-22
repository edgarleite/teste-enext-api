<?php

namespace app\controllers;

use Yii;
use app\models\User;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class UserController extends \yii\rest\ActiveController
{
	public $modelClass = 'app\models\User';

    /**
     * @return \yii\web\Response
     */
    public function actionLogin(string $username, string $password)
    {
    	$user = User::find()->where(['username' => $username, 'password' => md5($password)])->one();

    	if ($user !== null) {
    		$signer = new Sha256();

			$token = Yii::$app->jwt->getBuilder()
	            ->setIssuer('http://localhost:8888') // Configures the issuer (iss claim)
	            ->setAudience('http://localhost:8888') // Configures the audience (aud claim)
	            ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
	            ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
	            ->setNotBefore(time() + 60) // Configures the time before which the token cannot be accepted (nbf claim)
	            ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
	            ->set('uid', $user->id) // Configures a new claim, called "uid"
	            ->sign($signer, 'testing') // creates a signature using "testing" as key
	            ->getToken(); // Retrieves the generated token

	        return $this->asJson([
	            'token' => (string) $token,
	        ]);
    	}

    	return null;
    }
}
