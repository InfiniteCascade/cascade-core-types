<?php
namespace cascade\modules\core\TypeAgreement\models;

use Yii;

use cascade\models\Registry;

/**
 * This is the model class for table "object_agreement".
 *
 * @property string $id
 * @property string $number
 * @property string $title
 * @property string $description
 * @property string $start
 * @property string $end
 * @property string $hours
 * @property string $revenue
 * @property string $cost
 * @property string $created
 * @property string $modified
 *
 * @property Registry $registry
 */
class ObjectAgreement extends \cascade\components\types\ActiveRecord
{
	public $descriptorField = 'title';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'object_agreement';
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
			[['description'], 'string'],
			[['start', 'end'], 'safe'],
			[['hours', 'revenue', 'cost'], 'number'],
			[['id'], 'string', 'max' => 36],
			[['number'], 'string', 'max' => 25],
			[['title'], 'string', 'max' => 200]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function fieldSettings()
	{
		return [
			'number' => [],
			'title' => [],
			'description' => ['formField' => ['type' => 'textarea']],
			'start' => [],
			'end' => [],
			'hours' => ['formField' => ['fieldConfig' => ['inputGroupPostfix' => 'hours']]],
			'revenue' => ['formField' => ['fieldConfig' => ['inputGroupPrefix' => '<i class="fa fa-'.Yii::$app->params['currency'].'"></i>']]],
			'cost' => ['formField' => ['fieldConfig' => ['inputGroupPrefix' => '<i class="fa fa-'.Yii::$app->params['currency'].'"></i>']]],
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
		$settings['fields'][] = ['number' => ['columns' => 4], 'title'];
		$settings['fields'][] = ['description'];
		$settings['fields'][] = ['start', 'end'];
		$settings['fields'][] = ['hours', 'revenue', 'cost'];
		// $settings['fields'][] = [];
		return $settings;
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'number' => 'Number',
			'title' => 'Title',
			'description' => 'Description',
			'start' => 'Start',
			'end' => 'End',
			'hours' => 'Hours',
			'revenue' => 'Revenue',
			'cost' => 'Cost',
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
