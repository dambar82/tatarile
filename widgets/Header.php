<?php
/**
 * Created by PhpStorm.
 * User: User 50
 * Date: 14.11.2016
 * Time: 13:16
 */
namespace app\widgets;

use app\modules\statistics\models\AdminActionStatistics;

class Header extends \yii\bootstrap\Widget
{
    public function init(){}

    public function run() {
        $adminActStat = AdminActionStatistics::findOne([
            'name' => 'contact_form',
            'status' => 1
        ]);
        if($adminActStat) {
            $actionSum = $adminActStat->count;
            $viewsActionSum = $adminActStat->views_count;
            $newActionsCount = $actionSum-$viewsActionSum;
        }
        else {
            $newActionsCount = 0;
        }
        if(!$newActionsCount) $newActionsCount = '';
        return $this->render('header/view', [
            'newActionsCount' => $newActionsCount,
        ]);
    }
}