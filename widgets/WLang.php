<?php
/**
 * Created by PhpStorm.
 * User: User 50
 * Date: 14.11.2016
 * Time: 13:16
 */
namespace app\widgets;
use app\models\Lang;

class WLang extends \yii\bootstrap\Widget
{
    public function init(){}

    public function run() {
        return $this->render('lang/view', [
            'current' => Lang::getCurrent(),
            'langs' => Lang::find()->orderBy('id DESC')->all(),
        ]);
    }
}
