<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "formula_product".
 *
 * @property int $formula_id
 * @property int $product_id
 * @property string $product_ concentration
 *
 * @property Formula $formula
 * @property Product $product
 */
class FormulaProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'formula_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['formula_id', 'product_id', 'product_ concentration'], 'required'],
            [['formula_id', 'product_id'], 'integer'],
            [['product_ concentration'], 'number'],
            [['formula_id'], 'exist', 'skipOnError' => true, 'targetClass' => Formula::className(), 'targetAttribute' => ['formula_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'formula_id' => 'Formula ID',
            'product_id' => 'Product ID',
            'product_ concentration' => 'Product Concentration',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormula()
    {
        return $this->hasOne(Formula::className(), ['id' => 'formula_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
