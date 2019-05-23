<?php

namespace app\controllers;

use Yii;
use sizeg\jwt\JwtHttpBearerAuth;
use app\models\Formula;
use app\models\FormulaProduct;

class FormulaController extends \yii\rest\ActiveController
{
	public $modelClass = 'app\models\Formula';

    /**
     * @inheritdoc
     */
    public function init()
    {
    }
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
        unset($actions['create']);
        return $actions;
    }

	/**
	 * Creates formula
	 */
	public function actionCreate() 
	{
		$formula = new Formula();
		$formula->attributes = Yii::$app->request->post('formula');

		if ($formula->validate()) {
			if ($formula->save()) {
				 return $this->addFormulaProducts($formula, Yii::$app->request->post('formulaProducts'));
			}
		} else {
			return $formula->getErrors();
		}
	}

	/**
	 * Add formula products
	 */
	public function addFormulaProducts(\app\models\Formula $formula, array $products) 
	{
		foreach ($products as $product) {
			$formulaProduct = new FormulaProduct();
			$formulaProduct->attributes = $product;
			$formulaProduct->link('formula', $formula);
		}

		return $this->calculate($formula);
	}

	/**
	 * Calculates formula
	 */
	private function calculate(\app\models\Formula $formula) 
	{
		$vegetalization = 0;
		$countProducts = count($formula->formulaProducts);

		if ($countProducts > 0) {
			foreach ($formula->formulaProducts as $key => $formulaProduct) {
				$vegetalization += $formulaProduct->product_concentration * ($formulaProduct->product->vegetalization / 100);
			}

			$formula->vegetalization = number_format(($vegetalization / $countProducts), 2);
			if (!$formula->validate() && !$formula->save()) {
				die('erro');
				return $formula->getErrors();
			}
			
			return $formula;
		}
	}
}
