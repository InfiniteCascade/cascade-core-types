<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeFile\models;

use cascade\models\Storage;
use infinite\helpers\Html;

/**
 * ObjectFile is the model class for table "object_file".
 *
 * @property string $id
 * @property string $storage_id
 * @property string $name
 * @property string $created
 * @property string $modified
 *
 * @property Registry $registry
 * @property Storage $storage
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class ObjectFile extends \cascade\components\types\ActiveRecord
{
	protected $_labelName;
	public $descriptorField = 'labelName';

	public function getLabelName()
	{
		if (is_null($this->_labelName)) {
			$this->_labelName = $this->name;
			$storage = $this->storage;
			if (!empty($storage)) {
				if (empty($this->_labelName)) {
					$this->_labelName = $storage->file_name;
				} else {
					$this->_labelName .= " ({$storage->file_name})";
				}
			}
		}
		return $this->_labelName;
	}

	/**
	* @inheritdoc
	**/
	public static function searchFields()
	{
		$modelClass = get_called_class();
		$model = new $modelClass;
		$fields = [];
		$fields[] = ['name'];
		$fields[] = ['{{storage}}.[[file_name]]'];
		return $fields;
	}

	public function setLabelName($value)
	{
		if (!empty($this->name)) {
			$this->_labelName = $this->name .' ('.$value.')';
		} else {
			$this->_labelName = $value;
		}
	}

	/**
	* @inheritdoc
	**/
	public static function find()
	{
		$query = parent::find();
		$alias = $query->primaryAlias;
		$query->select(['`'. $alias .'`.*', '`storage`.`file_name` as `labelName`']);
		$query->join('INNER JOIN', Storage::tableName() .' storage', '`storage`.`id` = `'.$alias.'`.`storage_id`');
		return $query;
	}

/*	public function getDescriptor()
	{
		$label = $this->name;
		$storage = $this->storage;
		if (!empty($storage)) {
			if (empty($label)) {
				$label = $storage->file_name;
			} else {
				$label .= " ({$storage->file_name})";
			}
		}
		return $label;
	}*/

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
		return array_merge(parent::behaviors(), [
				'Storage' => [
					'class' => 'cascade\\components\\storageHandlers\\StorageBehavior',
				]
			]);
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['storage_id'], 'required', 'on' => 'create'],
			[['labelName'], 'safe'],
			[['id'], 'string', 'max' => 36],
			[['name'], 'string', 'max' => 255]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function fieldSettings()
	{
		return [
			'name' => [],
			'storage_id' => ['formField' => ['type' => 'file']],
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
		$settings['fields'][] = ['name'];
		$settings['fields'][] = ['storage_id'];
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
			'storage_id' => 'File',
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

	public function getDownloadLink($label = null, $htmlAttributes = [])
	{
		if (is_null($label)) {
			$label = $this->descriptor;
		}
		return Html::a($label, ['/object/view', 'subaction' => 'download',  'id' => $this->id]);
	}
}
