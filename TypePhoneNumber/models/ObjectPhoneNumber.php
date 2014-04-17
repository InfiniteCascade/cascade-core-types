<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypePhoneNumber\models;

use cascade\models\Registry;

/**
 * ObjectPhoneNumber is the model class for table "object_phone_number".
 *
 * @property string $id
 * @property string $phone
 * @property string $extension
 * @property boolean $no_call
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
class ObjectPhoneNumber extends \cascade\components\types\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
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
			[['id', 'created_user_id', 'modified_user_id'], 'string', 'max' => 36],
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
		];
	}

	/**
	 * __method_getFormattedExtension_description__
	 * @return __return_getFormattedExtension_type__ __return_getFormattedExtension_description__
	 */
	public function getFormattedExtension()
	{
		if (empty($this->extension)) { return null; }
		return 'x'. $this->extension;
	}

	/**
	 * __method_getRegistry_description__
	 * @return \yii\db\ActiveRelation
	 */
	public function getRegistry()
	{
		return $this->hasOne(Registry::className(), ['id' => 'id']);
	}
	
	/**
	 * __method_getCreatedUser_description__
	 * @return \yii\db\ActiveRelation
	 */
	public function getCreatedUser()
	{
		return $this->hasOne(Yii::$app->classes['User'], ['id' => 'created_user_id']);
	}
	
	/**
	 * __method_getModifiedUser_description__
	 * @return \yii\db\ActiveRelation
	 */
	public function getModifiedUser()
	{
		return $this->hasOne(Yii::$app->classes['User'], ['id' => 'modified_user_id']);
	}
}
