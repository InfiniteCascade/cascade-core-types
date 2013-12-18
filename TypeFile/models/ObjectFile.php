<?php
namespace cascade\modules\core\TypeFile\models;

use cascade\models\Registry;

/**
 * This is the model class for table "object_file".
 *
 * @property string $id
 * @property string $name
 * @property string $file_name
 * @property string $type
 * @property integer $size
 * @property string $created
 * @property string $modified
 *
 * @property Registry $registry
 */
class ObjectFile extends \cascade\components\types\ActiveRecord
{
	public $descriptorField = 'name';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'object_file';
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
			[['file_name', 'type', 'size'], 'required'],
			[['size'], 'integer'],
			[['id'], 'string', 'max' => 36],
			[['name', 'file_name'], 'string', 'max' => 255],
			[['type'], 'string', 'max' => 100]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function fieldSettings()
	{
		return [
			'name' => [],
			'file_name' => ['formField' => ['type' => 'file']],
			'type' => [],
			'size' => []
		];
	}


	/**
	 * @inheritdoc
	 */
	public function formSettings($name, $settings = [])
	{
		if (!array_key_exists('title', $settings)) {
			$settings['title'] = false;
		}
		$settings['ignoreFields'] = ['size', 'type'];
		$settings['fields'] = [];
		$settings['fields'][] = ['file_name'];
		$settings['fields'][] = ['name'];
		return $settings;
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
			'file_name' => 'File Name',
			'type' => 'Type',
			'size' => 'Size',
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
