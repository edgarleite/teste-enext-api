<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\Product;
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

    public function actions() {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex() {
        $activeData = new ActiveDataProvider([
            'query' => Product::find()->user(),
            'pagination' => false
        ]);
        return $activeData;
    }
}
