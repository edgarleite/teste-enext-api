<?php 

namespace app\components;

use Yii;
use yii\db\ActiveRecord;
use yii\base\Behavior;

class ProductBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'afterFind',
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
        ];
    }

    public function afterFind($event)
    {
        $model = $event->sender;
    }

    public function beforeInsert($event)
    {
        $model = $event->sender;

        $this->setUserId($model);
    }

    private function setUserId(\app\models\Product $model)
    {
    	$model->user_id = Yii::$app->user->identity->id;
    }
}

