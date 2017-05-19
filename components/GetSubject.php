<?php

namespace app\components;

use app\backend\models\Entity;
use app\backend\models\Subject;
use app\backend\models\SubjectProperty;
use Yii;
use yii\base\Exception;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use app\backend\models\EntityEav;
use app\backend\models\EntityType;
use app\backend\models\EntityProperty;
use app\models\Lang;

/**
 * Universal helper for common use cases
 * @package app\components
 */
class GetSubject
{
    public static function getSubjectProperties($id)
    {
        $result = '';

        if (($subject = Subject::findOne($id)) == NULL){
            return '';
        }

        if(($properties = $subject->subjectEavAssoc) == NULL) {
            return '';
        }

        if (($subject_properties = ArrayHelper::map(SubjectProperty::find()->all(),'id','type_id')) == NULL) { //map for properties
            return '';
        }

        foreach ($properties as $property) {
            $result[$subject_properties[$property->property_id]] = $property->value;
        }

        return $result;
    }

    public static function getSubjectTitle($id)
    {
        $props = static::getSubjectProperties($id);

        if (empty($props)) {
            $title = '';
        }
        else {
            $title = $props['1'];
        }

        return $title;
    }
}
