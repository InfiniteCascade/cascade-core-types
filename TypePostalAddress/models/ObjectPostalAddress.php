<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypePostalAddress\models;

use Yii;

use cascade\models\Registry;
use infinite\helpers\Locations;

/**
 * ObjectPostalAddress is the model class for table "object_postal_address".
 *
 * @property string $id
 * @property string $name
 * @property string $type
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $subnational_division
 * @property string $postal_code
 * @property string $country
 * @property boolean $no_mailings
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
class ObjectPostalAddress extends \cascade\components\types\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public $descriptorField = ['name', 'citySubnational'];

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'object_postal_address';
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
			[['type'], 'string'],
			[['no_mailings'], 'boolean'],
			[['id', 'created_user_id', 'modified_user_id'], 'string', 'max' => 36],
			[['city'], 'required'],
			[['name', 'address1', 'address2', 'city', 'country'], 'string', 'max' => 255],
			[['subnational_division'], 'string', 'max' => 100],
			[['postal_code'], 'string', 'max' => 20]
		];
	}


	/**
	 * @inheritdoc
	 */
	public function fieldSettings()
	{
		return [
			'name' => [],
			'type' => [],
			'address1' => [],
			'address2' => [],
			'city' => [],
			'subnational_division' => [
				'default' => Yii::$app->params['defaultSubnationalDivision'],
				'formField' => ['type' => 'smartDropDownList', 'smartOptions' => ['watchField' => 'country', 'fallbackType' => ['tag' => 'input', 'type' => 'text'], 'options' => Locations::allSubnationalDivisions(), 'blank' => true], 'options' => []],
			],
			'postal_code' => [],
			'country' => [
				'default' => Yii::$app->params['defaultCountry'],
				'formField' => ['type' => 'dropDownList', 'options' => Locations::countryList()],
			],
			'no_mailings' => []
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
		$settings['fields'][] = ['relation', 'name' => ['columns' => 8]];
		$settings['fields'][] = ['address1', 'address2'];
		$settings['fields'][] = ['city', 'subnational_division', 'postal_code'];
		$settings['fields'][] = ['country', false, false];
		return $settings;
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
			'type' => 'Type',
			'address1' => 'Address (Line 1)',
			'address2' => 'Address (Line 2)',
			'city' => 'City',
			'subnational_division' => 'State/Province/Region',
			'postal_code' => 'Postal Code',
			'country' => 'Country',
			'no_mailings' => 'No Mailings',
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


	/**
	 * Get unique country
	 * @return __return_getUniqueCountry_type__ __return_getUniqueCountry_description__
	 */
	public function getUniqueCountry() {
		if ($this->country !==Yii::$app->params['defaultCountry']) {
			$countries = Locations::countryList();
			return $countries[$this->country];
		}
		return null;
	}


	/**
	 * Get csz
	 * @return __return_getCsz_type__ __return_getCsz_description__
	 */
	public function getCsz() {
		$str = $this->city;
		if (!empty($this->subnational_division)) {
			$str .= ", ". $this->subnational_division;
		}
		if (!empty($this->postal_code)) {
			$str .= " ". $this->postal_code;
		}
		return $str;
	}

	/**
	 * Get city subnational
	 * @return __return_getCitySubnational_type__ __return_getCitySubnational_description__
	 */
	public function getCitySubnational() {
		$str = $this->city;
		if (!empty($this->subnational_division)) {
			$str .= ", ". $this->subnational_division;
		}
		return $str;
	}

	/**
	 * Get flat address url
	 * @return __return_getFlatAddressUrl_type__ __return_getFlatAddressUrl_description__
	 */
	public function getFlatAddressUrl()
	{
		return urlencode($this->flatAddress);
	}
	
	/**
	 * Get flat address
	 * @return __return_getFlatAddress_type__ __return_getFlatAddress_description__
	 */
	public function getFlatAddress()
	{
		$parts = ['address1', 'address2', 'csz', 'country'];
		$address = [];
		foreach ($parts as $part) {
			if (isset($this->{$part})) {
				$address[] = $this->{$part};
			}
		}
		return implode(', ', $address);
	}
}
