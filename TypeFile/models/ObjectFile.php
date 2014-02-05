<?php
namespace cascade\modules\core\TypeFile\models;



/**
 * This is the model class for table "object_file".
 *
 * @property string $id
 * @property string $storage_id
 * @property string $name
 * @property string $created
 * @property string $modified
 *
 * @property Registry $registry
 * @property Storage $storage
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
			[['storage_id'], 'required'],
			[['id', 'storage_id'], 'string', 'max' => 36],
			[['name'], 'string', 'max' => 255]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function fieldSettings()
	{
		return [
			'name' => []
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
			'storage_id' => 'Storage ID',
			'name' => 'Name',
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

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getStorage()
	{
		return $this->hasOne(Storage::className(), ['id' => 'storage_id']);
	}
}
