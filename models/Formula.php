<?php

namespace app\models;

use Yii;
use app\components\FormulaBehavior;

/**
 * This is the model class for table "formula".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property int $vegetalization
 *
 * @property User $user
 * @property FormulaProduct[] $formulaProducts
 */
class Formula extends \yii\db\ActiveRecord
{
    public $data = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'formula';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id'], 'integer'],
            [['vegetalization'], 'number'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'vegetalization' => 'Vegetalization',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            FormulaBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        $fields = parent::fields();
        $fields[] = 'formulaProducts';

        return $fields;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormulaProducts()
    {
        return $this->hasMany(FormulaProduct::className(), ['formula_id' => 'id']);
    }
}
