<?php

namespace app\components;

use app\backend\models\Entity;
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
class GetEntity
{

        public static function getFavorite($favorite_array)
        {
            $result=[];

            $entity_type=ArrayHelper::map(EntityType::find()->all(),'id','entity_type');
            $entity_ids = [];
            foreach ($favorite_array as $key => $value) {
                $entity_ids[] = $value->entity_id;
            }
            $entities = ArrayHelper::map(Entity::find()->select(['id','entity_type_id'])->where(['id' => $entity_ids])->asArray()->all(),'id','entity_type_id');
            foreach ($favorite_array as $key => $value) {
                $res = self::getEntityProperties($value->entity_id);
                $result[$entity_type[$entities[$value->entity_id]]][] = $res;
            }
            return $result;
        }

    public static function getTitle($entity_array)
    {
        $entity_type=ArrayHelper::map(EntityType::find()->all(),'id','entity_type');
        $result = [];
        foreach ($entity_array as $key => $value) {
            $res = self::getProperties($value->entity_id,['title']);
            $result[$entity_type[$res->entity_type]][] = $res[0];
        }
        return $result;
    }

    public static function getProperties(int $id, array $props = [],bool $assoc = FALSE)
    {
        $current_lang = Lang::getCurrent();
        $entity_type_id = Entity::find()->select('entity_type_id')->where(['id' => $id])->scalar();
        $conditions = ['lang_id' => $current_lang->id, 'entity_id' => $id];
        $properties = NULL;
        $propertiesAssoc = [];
        if(count($props) > 0) {
            $properties = EntityProperty::find()->where(['entity_type_id' => $entity_type_id, 'name' => $props])->asArray()->all();
            $conditions['property_id'] = [];
        }
        if($properties)  {
            foreach ($properties as $propertyI => $property) {
                $conditions['property_id'][] = $property['id'];
                $propertiesAssoc[$property['id']] = $property['name'];
            }
        }
        $property = EntityEav::find()->where($conditions)->all();
        if($assoc) {
            $assocAr = [];
            foreach ($property as $propertyM)
                $assocAr[$propertiesAssoc[$propertyM->property_id]] = $propertyM->value;
            return $assocAr;
        }
        return $property;
    }

    public static function getEntityProperties($id)
    {
        $result = '';

        if (($entity = Entity::findOne($id)) == NULL){
            return '';
        }

        if(($properties = $entity->entityEavAssoc) == NULL) {
            return '';
        }

        if (($entity_properties = ArrayHelper::map(EntityProperty::find()->where(['entity_type_id' => $entity->entity_type_id])->all(),'id','name')) == NULL) { //map for properties
            return '';
        }

        foreach ($properties as $property) {
            $result[$entity_properties[$property->property_id]] = $property->value;
            $result['entity_id']= $entity->id;
            $result['thumbnail']= $entity->thumbnail;
        }

        return $result;
    }

    public static function getEntityTitle($id)
    {
        $props = static::getEntityProperties($id);

        if (empty($props)) {
            $title = '';
        }
        else {
            $title = $props['title'];
        }

        return $title;
    }

    public static function getEntityPropertiesByLang($id,$lang_id)
    {
        $result = '';

        if (($entity = Entity::findOne($id)) == NULL){
            return NULL;
        }

        $entity->setEav();

        $properties = EntityEav::find()->where(['entity_id' => $id, 'lang_id' => $lang_id])->all();

        if (($entity_properties = ArrayHelper::map(EntityProperty::find()->where(['entity_type_id' => $entity->entity_type_id])->all(),'id','name')) == NULL) { //map for properties
            return NULL;
        }

        foreach ($properties as $property) {
            $result[$entity_properties[$property->property_id]] = $property->value;
        }
        $result['id'] = $id;
        $result['slug'] = $entity->slug;

        return $result;
    }

}
