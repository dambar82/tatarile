<?php

namespace app\modules\file\helpers;

use Yii;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\Point;

/**
 * Resize and fill
 */
class ResizeImage
{
    public static $width = 1150;
    public static $height = 900;
    public static $imgWebPath = 'files/1150x900/';
    public static $imgWebAbsolutePath = '@webroot/files/1150x900/';
    public static $imgOriginalPath = 'files/thumb/';

    public static function resize($img)
    {
        $collage = Image::getImagine()->create(new Box(static::$width, static::$height));

        if (!file_exists(Yii::getAlias(static::$imgWebAbsolutePath))) {mkdir(Yii::getAlias(static::$imgWebPath));}

        $original_image = Image::getImagine()->open(Yii::getAlias('@web').static::$imgOriginalPath.$img);
        $original_size = $original_image->getSize();

        $width_ratio = $original_size->getWidth()/static::$width;
        $height_ratio = $original_size->getHeight()/static::$height;

        $ratio = ($width_ratio > $height_ratio ? $width_ratio : $height_ratio);

        $width = $original_size->getWidth()/$ratio;
        $height = $original_size->getHeight()/$ratio;

        Image::getImagine()->open(Yii::getAlias(static::$imgOriginalPath).$img)
            ->thumbnail(new Box($width, $height))
            ->save(Yii::getAlias(static::$imgWebPath).$img , ['quality' => 90]);

//        $im = Image::getImagine()->open(Yii::getAlias(static::$imgWebPath).$img);
//
//        $im_size = $im->getSize();
//        $insert_width = (static::$width - $im_size->getWidth()) / 2;
//        $insert_height = (static::$height - $im_size->getHeight()) / 2;
//
//        $collage->paste($im,new Point($insert_width,$insert_height))->save(Yii::getAlias(static::$imgWebPath).$img);
    }

}
