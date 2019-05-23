<?php

namespace app\controllers;

use Yii;
use app\models\Formula;
use app\models\FormulaProducts;

class FormulaController extends \yii\rest\ActiveController
{
	public $modelClass = 'app\models\Formula';

	/**
	 * Calculates formula
	 */
	public function actionCalculate() 
	{
		$formula = new Formula();
		$formula->attributes = Yii::$app->request->post('formula');

		if ($formula->validate()) {
			if ($formula->save()) {
				return $formula;
			}
		} else {
			return $formula->getErrors();
		}
	}
}
