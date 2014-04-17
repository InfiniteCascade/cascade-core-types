<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeTask\models;

use cascade\models\Registry;

/**
 * ObjectTask is the model class for table "object_task".
 *
 * @property string $id
 * @property string $task
 * @property string $start
 * @property string $end
 * @property int $priority
 * @property int $position
 * @property boolean $completed
 * @property string $created
 * @property string $created_user_id
 * @property string $modified
 * @property string $modified_user_id
 *
 * @property User $createdUser
 * @property User $modifiedUser
 * @property Registry $registry
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class ObjectTask extends \cascade\components\types\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
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
			[['completed', 'start', 'end', 'priority', 'position'], 'safe'],
			[['id', 'created_user_id', 'modified_user_id'], 'string', 'max' => 36]
		];
	}

	/**
	* @inheritdoc
	**/
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
			'position' => [],
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
			'position' => 'Position',
			'completed' => 'Completed',
			'created' => 'Created Date',
			'created_user_id' => 'Created by User',
			'modified' => 'Modified Date',
			'modified_user_id' => 'Modified by User',
		];
	}

	/**
	 * Get registry
	 * @return \yii\db\ActiveRelation
	 */
	public function getRegistry()
	{
		return $this->hasOne(Registry::className(), ['id' => 'id']);
	}
	
	/**
	 * Get created user
	 * @return \yii\db\ActiveRelation
	 */
	public function getCreatedUser()
	{
		return $this->hasOne(Yii::$app->classes['User'], ['id' => 'created_user_id']);
	}


	/**
	 * Get modified user
	 * @return \yii\db\ActiveRelation
	 */
	public function getModifiedUser()
	{
		return $this->hasOne(Yii::$app->classes['User'], ['id' => 'modified_user_id']);
	}
}
