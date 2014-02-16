<?php
namespace cascade\modules\core\TypeTime\models;

use cascade\models\Registry;

/**
 * This is the model class for table "object_time".
 *
 * @property string $id
 * @property string $description
 * @property string $hours
 * @property string $log_date
 * @property binary $billable
 * @property string $created
 * @property string $modified
 *
 * @property Registry $registry
 */
class ObjectTime extends \cascade\components\types\ActiveRecord
{
	public $descriptorField = 'hoursWithUnit';

	public function getHoursWithUnit()
	{
		if ($this->hours == 1) {
			$postfix = ' hour';
		} else {
			$postfix = ' hours';
		}
		return $this->hours . $postfix;
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'object_time';
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
			[['description'], 'string'],
			[['hours'], 'number'],
			[['log_date', 'billable'], 'safe'],
			[['id', 'contributor_individual_id'], 'string', 'max' => 36]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function fieldSettings()
	{
		return [
			'description' => [],
			'hours' => [
				'format' => [],
				'formField' => ['fieldConfig' => ['inputGroupPostfix' => 'hours']]
			],
			'log_date' => []
		];
	}


	/**
	 * @inheritdoc
	 */
	public function formSettings($name, $settings = [])
	{
		if (!isset($settings['fields'])) {
			$settings['fields'] = [];
		}
		$settings['fields'][] = ['hours', 'log_date'];
		$settings['fields'][] = ['description'];
		return $settings;
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'contributor_individual_id' => 'Contributor',
			'description' => 'Description',
			'hours' => 'Hours',
			'log_date' => 'Log Date',
			'billable' => 'Billable',
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
