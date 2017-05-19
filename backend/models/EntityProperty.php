<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "entity_property".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type_id
 * @property integer $view
 * @property string $name
 * @property integer $entity_type_id
 */
class EntityProperty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_property';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type_id'], 'required'],
            [['type_id', 'view','entity_type_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 50],
            [['name'],'validateName']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'type_id' => 'Type ID',
            'view' => 'View',
            'entity_type_id' => 'Entity type ID',
            'name' => 'Property name'
        ];
    }
    public function getTypeName()
    {
        $parent = PropertyType::find()->where(['id'=>$this->type_id])->one();
        return Yii::t('app', $parent ? $parent->title : '');
    }
    public function forView() {
        if ($this->view==1) {return 'Значение по умолчанию';} else {return 'Стандартное значение';}
    }
    public function validateName()
    {
        if (preg_match('/^([a-z])+([a-z_0-9]{0,})+([a-z0-9])$/',$this->name)) {
            $oldmodel = EntityProperty::findOne([
                'name' => $this->name,
                'entity_type_id' => $this->entity_type_id
            ]);
            if ($oldmodel) {
                $this->addError('name', 'This content type already has a field with this name');
            }
        }
        else {
            $this->addError('name', 'Incorrect name');
        }
    }
}
