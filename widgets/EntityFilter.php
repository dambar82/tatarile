<?php
/**
 * Created by PhpStorm.
 * User: User 50
 * Date: 14.11.2016
 * Time: 13:16
 */
namespace app\widgets;
use app\models\Lang;

class EntityFilter extends \yii\bootstrap\Widget
{
    public function init(){}

    public function run() {
        return $this->render('entityfilter/view', [
            'current' => Lang::getCurrent(),
            'langs' => Lang::find()->where('id != :current_id', [':current_id' => Lang::getCurrent()->id])->all(),
        ]);
    }
}