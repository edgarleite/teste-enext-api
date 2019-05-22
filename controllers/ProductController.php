<?php

namespace app\controllers;

use Yii;
// use bizley\jwt\JwtHttpBearerAuth;
use sizeg\jwt\JwtHttpBearerAuth;

class ProductController extends \yii\rest\ActiveController
{
	public $modelClass = 'app\models\Product';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
        ];

        return $behaviors;
    }
}
