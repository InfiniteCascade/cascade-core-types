<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeAgreement\models;

use Yii;

use cascade\models\Registry;
use infinite\helpers\Date;

/**
 * ObjectAgreement is the model class for table "object_agreement".
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
 * @property string $created_user_id
 * @property string $modified
 * @property string $modified_user_id
 * @property string $archived
 * @property string $archived_user_id
 *
 * @property User $createdUser
 * @property User $archivedUser
 * @property User $modifiedUser
 * @property Registry $registry
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class ObjectAgreement extends \cascade\components\types\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
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

	public function getSubdescriptorFields()
    {
        return [['parent:Account' => ['relationOptions' => ['taxonomy' => [['systemId' => 'contractee']]]], 'dateRange']];
    }

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['title'], 'required'],
			[['description'], 'string'],
			[['start', 'end'], 'safe'],
			[['hours', 'revenue', 'cost'], 'number'],
			[['id', 'created_user_id', 'modified_user_id', 'archived_user_id'], 'string', 'max' => 36],
			[['number'], 'string', 'max' => 25],
			[['title'], 'string', 'max' => 200]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function getDefaultValues()
	{
		return [
			'start' => Date::date("m/d/Y")
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
			'description' => [],
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
			'created' => 'Created Date',
			'created_user_id' => 'Created by User',
			'modified' => 'Modified Date',
			'modified_user_id' => 'Modified by User',
			'archived' => 'Archived Date',
			'archived_user_id' => 'Archived by User',
		];
	}

	public function getDateRange()
	{
		$fields = $this->getFields();
		if (!empty($this->start) && empty($this->end)) {
			return 'since ' . $fields['start']->formattedValue;
		} elseif (empty($this->start) && !empty($this->end)) {
			return 'until ' . $fields['end']->formattedValue;
		} else {
			return implode(' – ', [$fields['start']->formattedValue, $fields['end']->formattedValue]);
		}
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
	 * Get archived user
	 * @return \yii\db\ActiveRelation
	 */
	public function getArchivedUser()
	{
		return $this->hasOne(Yii::$app->classes['User'], ['id' => 'archived_user_id']);
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
