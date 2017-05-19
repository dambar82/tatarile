<?php

use yii\db\Migration;

class m161226_135640_add_eav_indexes extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $entity_types = \app\backend\models\EntityType::find()->all();
        foreach ($entity_types as $entity_type) {
            $this->createIndex('entity_id_lang_id_property_id','entity_eav_'.$entity_type->entity_type,[
                'entity_id',
                'lang_id',
                'property_id'
            ],true);
            $this->createIndex('entity_id','entity_eav_'.$entity_type->entity_type,[
                'entity_id'
            ]);
            $this->createIndex('lang_id','entity_eav_'.$entity_type->entity_type,[
                'lang_id'
            ]);
            $this->createIndex('property_id','entity_eav_'.$entity_type->entity_type,[
                'property_id'
            ]);
        }
        $this->createIndex('tag','entity_tags',[
            'tag'
        ]);
        $this->createIndex('entity_id','entity_tags',[
            'entity_id'
        ]);
        $this->createIndex('lang_id','entity_tags',[
            'lang_id'
        ]);
        $this->createIndex('entity_type_id_name','entity_property',[
            'entity_type_id',
            'name'
        ]);
        $this->createIndex('entity_type_id','entity_property',[
            'entity_type_id'
        ]);
        $this->createIndex('name','entity_property',[
            'name'
        ]);
    }

    public function safeDown()
    {
    }
}
