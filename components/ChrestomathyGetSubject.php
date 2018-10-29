<?php

namespace app\components;

use app\models\chrestomathy\ChrestomathySubject;
use app\backend\models\SubjectProperty;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Universal helper for common use cases
 * @package app\components
 */
class ChrestomathyGetSubject
{
    public static function getSubjectProperties($id)
    {
        $result = '';

        if (($subject = ChrestomathySubject::findOne($id)) == NULL){
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
