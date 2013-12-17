<?php
namespace cascade\modules\core\TypeActivity\models;

use cascade\models\Registry;

/**
 * This is the model class for table "object_activity".
 *
 * @property string $id
 * @property string $summary
 * @property string $details
 * @property string $start
 * @property string $end
 * @property string $created
 * @property string $modified
 *
 * @property Registry $registry
 */
class ObjectActivity extends \cascade\components\types\ActiveRecord
{
	public $descriptorField = 'summary';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'object_activity';
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
			[['summary'], 'required'],
			[['details'], 'string'],
			[['start', 'end'], 'safe'],
			[['id'], 'string', 'max' => 36],
			[['summary'], 'string', 'max' => 255]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function fieldSettings()
	{
		return [
			'summary' => [],
			'details' => [],
			'start' => [],
			'end' => []
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
			'summary' => 'Summary',
			'details' => 'Details',
			'start' => 'Start',
			'end' => 'End',
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
