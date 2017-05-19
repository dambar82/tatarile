<?php

namespace app\modules\file\widgets;

use app\backend\models\Entity;
use Yii;


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

        if (empty($this->id)) {
            $thumbnail = Yii::getAlias($this->defaultThumbnailFolder).$this->defaultThumbnail;
            return $this->render('thumbnail/index',['thumbnail'=>$thumbnail]);
        }

        if (($entity = Entity::findOne($this->id)) == NULL) {
            $thumbnail = Yii::getAlias($this->defaultThumbnailFolder).$this->defaultThumbnail;
            return $this->render('thumbnail/index',['thumbnail'=>$thumbnail]);
        }

        $thumbnail = $entity->thumbnail;

        if (empty($thumbnail)) {
            $entity_type = $entity->entity_type_id;

            if (!file_exists(Yii::getAlias($this->defaultThumbnailAbsoluteFolder).$entity_type.'.png')) {
                $thumbnail = Yii::getAlias($this->defaultThumbnailFolder).$this->defaultThumbnail;
            }
            else {
                $thumbnail = Yii::getAlias($this->defaultThumbnailFolder).$entity_type.'.png';
            }
            return $this->render('thumbnail/index',['thumbnail'=>$thumbnail]);
        }

        if (!file_exists(Yii::getAlias($this->thumbnailAbsoluteFolder).$thumbnail)) {
            $thumbnail = Yii::getAlias($this->defaultThumbnailFolder).$this->defaultThumbnail;
            return $this->render('thumbnail/index',['thumbnail'=>$thumbnail]);
        }

        $thumbnail = Yii::getAlias($this->thumbnailFolder).$thumbnail;
        return $this->render('thumbnail/index',['thumbnail'=>$thumbnail]);

    }
}
