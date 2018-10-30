<?php

namespace app\modules\admin\models;

use Yii;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "pdf_content".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property string $filename
 */
class PdfContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pdf_content';
    }

    public function behaviors()
    {
        return [
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'razvorot',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@webroot') . '/files/gallery',
                'url' => Yii::getAlias('@web') . '/files/gallery',
                'versions' => [
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id'], 'required'],
            [['entity_id'], 'integer'],
            [['filename'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => 'Entity ID',
            'filename' => 'Filename',
        ];
    }
}
