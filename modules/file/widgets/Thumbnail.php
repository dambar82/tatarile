<?php

namespace app\modules\file\widgets;

use app\backend\models\Entity;
use app\models\chrestomathy\ChrestomathyEntity;
use Yii;
use yii\helpers\VarDumper;


class Thumbnail extends \yii\bootstrap\Widget
{
    public $id = NULL;
    public $thumbnailFolder = '@web/files/280x230/';
    public $thumbnailAbsoluteFolder = '@webroot/files/280x230/';
    public $defaultThumbnailFolder = '@web/images/default/';
    public $defaultThumbnailAbsoluteFolder = '@webroot/images/default/';
    public $defaultThumbnail = 'default.png';

    public function init(){

    }

    public function run() {

        if (($entity = ChrestomathyEntity::findOne($this->id)) == NULL) {
            $thumbnail = Yii::getAlias($this->defaultThumbnailFolder).$this->defaultThumbnail;
            return $this->render('thumbnail/index',['thumbnail'=>$thumbnail]);
        }

        $thumbnail = $entity->thumbnail;

        $thumbnail = 'http://chrestomathy.local/files/thumb/'.$thumbnail;

        return $this->render('thumbnail/index2',['thumbnail'=>$thumbnail]);

    }
}
