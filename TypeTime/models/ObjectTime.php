<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeTime\models;

use cascade\models\Registry;

/**
 * ObjectTime is the model class for table "object_time".
 *
 * @property string $id
 * @property string $description
 * @property string $hours
 * @property string $log_date
 * @property binary $billable
 * @property string $created
 * @property string $created_user_id
 * @property string $modified
 * @property string $modified_user_id
 *
 * @property User $createdUser
 * @property User $archivedUser
 * @property User $modifiedUser
 * @property Registry $registry
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class ObjectTime extends \cascade\components\types\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public $descriptorField = 'hoursWithUnit';

	/**
	 * Get hours with unit
	 * @return __return_getHoursWithUnit_type__ __return_getHoursWithUnit_description__
	 */
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
			[['id', 'created_user_id', 'modified_user_id'], 'string', 'max' => 36]
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
			'description' => 'Description',
			'hours' => 'Hours',
			'log_date' => 'Log Date',
			'billable' => 'Billable',
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
