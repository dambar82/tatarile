<?php

namespace app\modules\file\widgets;

use app\backend\models\Entity;
use Yii;


class MainImage extends \yii\bootstrap\Widget
{
    public $image = NULL;
    public $alt = NULL;
    public $thumbnail_title = NULL;
    public $defaultThumbFolder = '@web/files/1150x900/';
    public $defaultThumbAbsoluteFolder = '@webroot/files/1150x900/';
    public $defaultFolder = '@web/files/thumb/';
    public $defaultAbsoluteFolder = '@webroot/files/thumb/';

    public function init(){

    }

    public function run() {

        if (!empty($this->image)) {
            if (!file_exists(Yii::getAlias($this->defaultThumbAbsoluteFolder).$this->image)) {
                if (file_exists(Yii::getAlias($this->defaultAbsoluteFolder).$this->image)) {
                    return $this->render('mainimage/index',['img' => Yii::getAlias($this->defaultFolder).$this->image,'alt' => $this->alt,'thumbnail_title' => $this->thumbnail_title]);
                }
            }
            else {
                return $this->render('mainimage/index',['img' => Yii::getAlias($this->defaultThumbFolder).$this->image,'alt' => $this->alt,'thumbnail_title' => $this->thumbnail_title]);
            }
        }
        return $this->render('mainimage/index',['img' => NULL,'alt' => '','thumbnail_title' => '']);
    }
}
