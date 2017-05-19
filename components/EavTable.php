<?php

namespace app\components;

use app\backend\models\EntityType;
use yii\web\NotFoundHttpException;

/**
 * Получение eav таблиц
 */
class EavTable
{
    public static function getBaseName($id)
    {
        if (empty($id)) {
            throw new NotFoundHttpException('Not fount entity_id.');
        }
        $table_name = EntityType::find()->select('entity_type')->where(['id' => $id])->scalar();
        if ($table_name == NULL) {
            throw new NotFoundHttpException('Not fount entity_id.');
        }
        return '\app\backend\models\EntityEav'.$table_name;
    }
    public static function getPostName($id)
    {
        if (empty($id)) {
            return 'EntityEav';
        }
        $table_name = EntityType::find()->select('entity_type')->where(['id' => $id])->scalar();
        if ($table_name == NULL) {
            return 'EntityEav';
        }
        return 'EntityEav'.$table_name;
    }
}
