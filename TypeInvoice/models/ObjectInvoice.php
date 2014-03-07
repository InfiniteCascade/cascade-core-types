<?php
namespace cascade\modules\core\TypeInvoice\models;

use cascade\models\Registry;

/**
 * This is the model class for table "object_invoice".
 *
 * @property string $id
 * @property string $number
 * @property string $revenue
 * @property string $start
 * @property string $end
 * @property string $created
 * @property string $modified
 *
 * @property Registry $registry
 */
class ObjectInvoice extends \cascade\components\types\ActiveRecord
{
	public $descriptorField = 'number';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'object_invoice';
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
			[['revenue'], 'number'],
			[['start', 'end'], 'safe'],
			[['id'], 'string', 'max' => 36],
			[['number'], 'string', 'max' => 40]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function fieldSettings()
	{
		return [
			'number' => [],
			'revenue' => [],
			'start' => [],
			'end' => [],
			'parent:Agreement' => [
			]
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
			'number' => 'Number',
			'revenue' => 'Revenue',
			'start' => 'Start',
			'end' => 'End',
			'parent:Agreement' => 'Agreement',
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
