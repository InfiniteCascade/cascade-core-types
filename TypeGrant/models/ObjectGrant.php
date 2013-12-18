<?php
namespace cascade\modules\core\TypeGrant\models;

use cascade\models\Registry;

/**
 * This is the model class for table "object_grant".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $determination
 * @property string $start
 * @property string $end
 * @property string $status
 * @property string $ask
 * @property string $award
 * @property string $created
 * @property string $modified
 *
 * @property Registry $registry
 */
class ObjectGrant extends \cascade\components\types\ActiveRecord
{
	public $descriptorField = 'title';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'object_grant';
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
			[['title', 'description'], 'required'],
			[['description', 'status'], 'string'],
			[['determination', 'start', 'end'], 'safe'],
			[['ask', 'award'], 'number'],
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
			'description' => [],
			'determination' => [],
			'start' => [],
			'end' => [],
			'status' => [],
			'ask' => [],
			'award' => []
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
			'title' => 'Title',
			'description' => 'Description',
			'determination' => 'Determination',
			'start' => 'Start',
			'end' => 'End',
			'status' => 'Status',
			'ask' => 'Ask',
			'award' => 'Award',
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