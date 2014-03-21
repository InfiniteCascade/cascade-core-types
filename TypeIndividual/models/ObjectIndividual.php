<?php
namespace cascade\modules\core\TypeIndividual\models;

use cascade\models\User;
use cascade\models\Registry;

/**
 * This is the model class for table "object_individual".
 *
 * @property string $id
 * @property string $prefix
 * @property string $suffix
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $title
 * @property string $department
 * @property string $birthday
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
 * @property User $user
 * @property User[] $users
 */
class ObjectIndividual extends \cascade\components\types\ActiveRecord
{
	public $descriptorField = ['first_name', 'middle_name', 'last_name'];
	public $subdescriptorFields = [['parent:Account', 'child:PostalAddress:citySubnational']];
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'object_individual';
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
			[['first_name'], 'required'],
			[['birthday'], 'safe'],
			[['id', 'created_user_id', 'modified_user_id', 'archived_user_id'], 'string', 'max' => 36],
			[['prefix', 'suffix', 'first_name', 'middle_name', 'last_name', 'title', 'department'], 'string', 'max' => 255]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function fieldSettings()
	{
		return [
			'prefix' => [],
			'suffix' => ['priority' => 720],
			'first_name' => [],
			'middle_name' => [],
			'last_name' => [],
			'title' => [],
			'department' => [],
			'birthday' => ['formField' => ['type' => 'date']]
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
		$settings['fields'] = [];
		$settings['fields'][] = ['first_name', 'middle_name', 'last_name'];
		$settings['fields'][] = ['title', 'department'];
		if ($this->isNewRecord) {
			$settings['fields'][] = ['child:EmailAddress' => ['linkExisting' => false], 'child:PhoneNumber' => ['linkExisting' => false]];
		}
		if (!$this->isNewRecord) {
			$settings['fields'][] = ['birthday', false];
		}
		return $settings;
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'user_id' => 'User ID',
			'prefix' => 'Prefix',
			'suffix' => 'Suffix',
			'first_name' => 'First Name',
			'middle_name' => 'Middle Name',
			'last_name' => 'Last Name',
			'title' => 'Title',
			'department' => 'Department',
			'birthday' => 'Birthday',
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

	/**
	 * @return \yii\db\ActiveRelation
	 */
	public function getUsers()
	{
		return $this->hasMany(User::className(), ['object_individual_id' => 'id']);
	}
}
