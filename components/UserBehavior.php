<?php 

namespace app\components;

use yii\db\ActiveRecord;
use yii\base\Behavior;

class UserBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'afterFind',
        ];
    }

    public function afterFind($event)
    {
        // var_dump("afterFind");die;
    }
}
