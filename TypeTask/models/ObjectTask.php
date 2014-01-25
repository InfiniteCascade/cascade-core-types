<?php
namespace cascade\modules\core\TypeTask\models;

use cascade\models\Registry;

/**
 * This is the model class for table "object_task".
 *
 * @property string $id
 * @property string $task
 * @property string $start
 * @property string $end
 * @property boolean $completed
 * @property string $created
 * @property string $modified
 *
 * @property Registry $registry
 */
class ObjectTask extends \cascade\components\types\ActiveRecord
{
	public $descriptorField = 'task';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'object_task';
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
			[['task'], 'required'],
			[['task'], 'string'],
			[['completed', 'start', 'end', 'priority'], 'safe'],
			[['id'], 'string', 'max' => 36]
		];
	}

	public function getDefaultValues()
	{
		return [
			'completed' => 0
		];
	}

	/**
	 * @inheritdoc
	 */
	public function fieldSettings()
	{
		return [
			'task' => [],
			'start' => [],
			'end' => [],
			'priority' => [],
			'completed' => []
		];
	}


	/**
	 * @inheritdoc
	 */
	public function formSettings($name, $settings = [])
	{
		$settings = parent::formSettings($name, $settings);
		if (!array_key_exists('title', $settings)) {
			$settings['title'] = false;
		}
		$settings['fields'] = [];
		$settings['fields'][] = ['task'];
		$settings['fields'][] = ['start', 'end'];
		$settings['fields'][] = ['completed'];

		return $settings;
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'task' => 'Task',
			'start' => 'Start Date',
			'end' => 'Due Date',
			'priority' => 'Priority',
			'completed' => 'Completed',
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
