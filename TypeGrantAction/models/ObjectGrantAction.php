<?php
namespace cascade\modules\core\TypeGrantAction\models;

use cascade\models\Registry;

/**
 * This is the model class for table "object_grant_action".
 *
 * @property string $id
 * @property string $type
 * @property string $description
 * @property string $start
 * @property string $end
 * @property string $status
 * @property string $created
 * @property string $modified
 *
 * @property Registry $registry
 */
class ObjectGrantAction extends \cascade\components\types\ActiveRecord
{
	public $descriptorField = 'description';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'object_grant_action';
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
			[['type', 'description', 'status'], 'string'],
			[['description'], 'required'],
			[['start', 'end'], 'safe'],
			[['id'], 'string', 'max' => 36]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function fieldSettings()
	{
		return [
			'type' => [],
			'description' => [],
			'start' => [],
			'end' => [],
			'status' => []
		];
	}


	/**
	 * @inheritdoc
	 */
	public function formSettings($name, $settings = [])
	{
		return parent::formSettings($name, $settings);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'type' => 'Type',
			'description' => 'Description',
			'start' => 'Start',
			'end' => 'End',
			'status' => 'Status',
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
