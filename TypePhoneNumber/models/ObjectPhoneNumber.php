<?php
namespace cascade\modules\core\TypePhoneNumber\models;

use cascade\models\Registry;

/**
 * This is the model class for table "object_phone_number".
 *
 * @property string $id
 * @property string $phone
 * @property string $extension
 * @property boolean $no_call
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
class ObjectPhoneNumber extends \cascade\components\types\ActiveRecord
{
	public $descriptorField = ['phone', 'formattedExtension'];

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'object_phone_number';
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
			[['phone'], 'required'],
			[['no_call'], 'boolean'],
			[['id', 'created_user_id', 'modified_user_id', 'archived_user_id'], 'string', 'max' => 36],
			[['phone'], 'string', 'max' => 100],
			[['extension'], 'string', 'max' => 15]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function fieldSettings()
	{
		return [
			'phone' => [],
			'extension' => [],
			'no_call' => []
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
		$settings['fields'][] = ['phone' => [ 'columns' => 8], 'extension' => ['columns' => 4]];
		if (!$this->isNewRecord) {
			$settings['fields'][] = ['no_call'];
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
			'phone' => 'Phone',
			'extension' => 'Extension',
			'no_call' => 'No Call',
			'created' => 'Created Date',
			'created_user_id' => 'Created by User',
			'modified' => 'Modified Date',
			'modified_user_id' => 'Modified by User',
			'archived' => 'Archived Date',
			'archived_user_id' => 'Archived by User',
		];
	}

	public function getFormattedExtension()
	{
		if (empty($this->extension)) { return null; }
		return 'x'. $this->extension;
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
