<?php 

namespace app\components;

use Yii;
use yii\db\ActiveRecord;
use yii\base\Behavior;

class UserBehavior extends Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function beforeInsert($event)
    {
        $model = $event->sender;

        if ($model) {
            if ($model->isNewRecord) {
                $model->password = md5($model->password);
                $model->auth_key = Yii::$app->security->generateRandomString();
            }
        }
    }
}
