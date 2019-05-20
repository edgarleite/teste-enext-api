<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $user_id
 * @property string $inci_name
 * @property int $basf
 * @property string $brand
 * @property int $vegetalization
 *
 * @property FormulaProduct[] $formulaProducts
 * @property User $user
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'inci_name', 'brand'], 'required'],
            [['user_id', 'basf', 'vegetalization'], 'integer'],
            [['inci_name', 'brand'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'inci_name' => 'Inci Name',
            'basf' => 'Basf',
            'brand' => 'Brand',
            'vegetalization' => 'Vegetalization',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormulaProducts()
    {
        return $this->hasMany(FormulaProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
