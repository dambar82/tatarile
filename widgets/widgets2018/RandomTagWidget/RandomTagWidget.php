<?php

namespace app\widgets\widgets2018\RandomTagWidget;

use app\backend\models\EntityTags;
use app\models\Lang;
use yii\base\Widget;
use yii\db\Expression;
use yii\web\View;

/* @var $this View */

class RandomTagWidget extends Widget
{
    public $lang_url;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $randomHashTags = [];
        for($i = 0; $i<3; $i++) {
            $notTag = "";
            if(count($randomHashTags) > 0) {
                foreach ($randomHashTags as $randomHashTagN) {
                    if(strlen($notTag) > 0)
                        $notTag .=" AND ";
                    $notTag .= "`tag` <>'".$randomHashTagN->tag."'";
                }
            }
            $randomHashTag = EntityTags::find()
                ->where(['lang_id' => Lang::getCurrent()->id])
                ->andWhere($notTag)
                ->offset(0)->limit(1)
                ->orderBy(new Expression('rand()'))
                ->all();
            if(count($randomHashTag) > 0)
                $randomHashTags[] = $randomHashTag[0];
        }

        return $this->render('@app/widgets/widgets2018/RandomTagWidget/views/index', [
            'randomHashTags' => $randomHashTags,
            'lang_url' => $this->lang_url
        ]);

    }
}