<?php
namespace cascade\modules\core\TypeProject\models;

use cascade\models\Registry;

/**
 * This is the model class for table "object_project".
 *
 * @property string $id
 * @property string $owner_user_id
 * @property string $title
 * @property string $description
 * @property string $start
 * @property string $end
 * @property boolean $active
 * @property string $created
 * @property string $modified
 *
 * @property Registry $registry
 */
class ObjectProject extends \cascade\components\types\ActiveRecord
{
	public $descriptorField = 'title';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'object_project';
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return array_merge(parent::behaviors(), []);
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title'], 'required'],
			[['description'], 'string'],
			[['start', 'end'], 'safe'],
			[['active'], 'boolean'],
			[['id'], 'string', 'max' => 36],
			[['title'], 'string', 'max' => 255]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function fieldSettings()
	{
		return [
			'title' => [],
			'description' => ['formField' => ['type' => 'textarea']],
			'start' => ['formField' => ['type' => 'date']],
			'end' => ['formField' => ['type' => 'date']],
			'active' => ['formField' => ['type' => 'checkBox']]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function formSettings($name, $settings = [])
	{
		$settings['fields'] = [];
		$settings['fields'][] = ['title'];
		$settings['fields'][] = ['description'];
		$settings['fields'][] = ['start', 'end'];
		if ($this->isNewRecord) {
			$settings['fields'][] = ['active'];
		}
		return $settings;
	}


	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
			'start' => 'Start',
			'end' => 'End',
			'active' => 'Active',
			'created' => 'Created',
			'modified' => 'Modified',
		];
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getRegistry()
	{
		return $this->hasOne(Registry::className(), ['id' => 'id']);
	}
}
