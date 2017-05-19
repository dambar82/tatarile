<?php
namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "menu_group".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property string $URL
 * @property string $position
 */
class MenuGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'position'], 'required'],
            [['type'], 'integer'],
            [['name', 'URL'], 'string', 'max' => 255],
            [['position'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'menuName'),
            'type' => Yii::t('app', 'menuType'),
            'URL' => Yii::t('app', 'menuUrl'),
            'position' => Yii::t('app', 'menuPosition'),
        ];
    }
	public function getParent() 
	{
		return $this->hasOne(MenuGroup::className(), ['id' => 'type']);
	}
	public function getParentName() 
	{
		$parent = $this->parent; 
		return Yii::t('app', $parent ? $parent->name : '');
	}
	public function getName() {
		if (!empty($this->parent->name))
		{
			return Yii::t('app', $this->parent->name);
		}
		
	}
}
