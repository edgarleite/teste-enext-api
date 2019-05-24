<?php

namespace app\models;

use Yii;

/**
 * This is the ActiveQuery class for [[Product]].
 *
 * @see Product
 */
class ProductQuery extends \yii\db\ActiveQuery
{
    /**
     * Find user products
     * @return Product[]|array
     */
    public function user()
    {
        return $this->andWhere(['user_id' => Yii::$app->user->identity->id])->orWhere(['user_id' => null]);
    }

    /**
     * Find sigegest
     * @return Product[]|array
     */
    public function suggest(string $query)
    {
        return $this->andFilterWhere(['like', 'inci_name',  $query]);
    }

    /**
     * {@inheritdoc}
     * @return Product[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Product|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
