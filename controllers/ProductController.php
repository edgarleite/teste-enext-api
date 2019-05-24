<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use sizeg\jwt\JwtHttpBearerAuth;
use app\models\Product;

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

    /**
     * Removes action to override
     */
    public function actions() {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    /**
     * Override index action
     *
     * @return ActiveDataProvider
     */
    public function actionIndex() {
        $activeData = new ActiveDataProvider([
            'query' => Product::find()->user(),
            'pagination' => false
        ]);
        return $activeData;
    }

    /**
     * Find product from suggest
     *
     * @param string $query
     * @return ActiveDataProvider
     */
    public function actionSuggest(string $query) {
        $activeData = new ActiveDataProvider([
            'query' => Product::find()->user()->suggest($query),
            'pagination' => false
        ]);
        return $activeData;
    }
}
