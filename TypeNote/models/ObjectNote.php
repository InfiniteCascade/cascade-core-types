<?php
namespace cascade\modules\core\TypeNote\models;

use cascade\models\Registry;

/**
 * This is the model class for table "object_note".
 *
 * @property string $id
 * @property string $title
 * @property string $note
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
 */
class ObjectNote extends \cascade\components\types\ActiveRecord
{
	public $descriptorField = 'title';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'object_note';
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
			[['note'], 'string'],
			[['id', 'created_user_id', 'modified_user_id', 'archived_user_id'], 'string', 'max' => 36],
			[['title'], 'string', 'max' => 255]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function fieldSettings()
	{
		return [
			'title' => [],
			'note' => []
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
			'title' => 'Title',
			'note' => 'Note',
			'created' => 'Created Date',
			'created_user_id' => 'Created by User',
			'modified' => 'Modified Date',
			'modified_user_id' => 'Modified by User',
			'archived' => 'Archived Date',
			'archived_user_id' => 'Archived by User',
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
	public function getCreatedUser()
	{
		return $this->hasOne(Yii::$app->classes['User'], ['id' => 'created_user_id']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getArchivedUser()
	{
		return $this->hasOne(Yii::$app->classes['User'], ['id' => 'archived_user_id']);
	}

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getModifiedUser()
	{
		return $this->hasOne(Yii::$app->classes['User'], ['id' => 'modified_user_id']);
	}
}
