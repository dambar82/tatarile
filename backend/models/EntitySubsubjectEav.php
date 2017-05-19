<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "entity_subsubject_eav".
 *
 * @property integer $id
 * @property integer $entity_id
 * @property integer $subject_id
 */
class EntitySubsubjectEav extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_subsubject_eav';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_id', 'subject_id'], 'required'],
            [['entity_id', 'subject_id'], 'integer','min' => 1],
            [['subject_id'],'checkSubject']
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
            'subject_id' => 'Subject ID',
        ];
    }
    public function checkSubject()
    {
        $subject = Subject::find()->where([
            'id' => $this->subject_id
        ]);
        $subject = $subject->andWhere([
           '>','parent_id',0
        ]);
        $subject = $subject->all();
        if($subject) {
            $old_eav = EntitySubsubjectEav::find()->where([
                'entity_id' => $this->entity_id,
                'subject_id' => $this->subject_id
            ]);
            if(!$this->isNewRecord)
                $old_eav = $old_eav->andWhere([
                    '<>','id',$this->id
                ]);
            $old_eav = $old_eav->all();
            if($old_eav)
                $this->addError('subject_id', 'this subject is already exists');
        }
        else {
            $this->addError('subject_id', 'this subject_id is not valid');
        }
    }
}
