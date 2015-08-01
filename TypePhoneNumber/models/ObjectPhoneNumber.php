<?php
/**
 * @link http://psesd.org/
 *
 * @copyright Copyright (c) 2015 Puget Sound ESD
 * @license http://psesd.org/license/
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
    public $descriptorField = ['formattedPhone'];

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
            [['extension'], 'string', 'max' => 15],
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
            'no_call' => [],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeValidate()
    {
        $originalPhone = $this->phone;
        $originalExtension = $this->extension;

        $phone = preg_replace('/[^0-9a-zA-Z]/', '', $originalPhone);
        preg_match('/([0-9]+)([a-zA-Z]*)([0-9]*)/', $phone, $matches);
        $this->phone = isset($matches[1]) ? $matches[1] : null;
        if (empty($originalExtension) || (isset($matches[3]) && $originalExtension === $matches[3])) {
            $this->extension = isset($matches[3]) ? $matches[3] : null;
        } else {
            unset($matches[0]);
            $this->phone = trim(implode(' ', $matches));
        }
        if (empty($this->phone)) {
            $this->phone = null;
        }
        if (empty($this->extension)) {
            $this->extension = null;
        }

        return parent::beforeValidate();
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
     * Get formatted extension.
     *
     * @return [[@doctodo return_type:getFormattedExtension]] [[@doctodo return_description:getFormattedExtension]]
     */
    public function getFormattedExtension()
    {
        if (empty($this->extension)) {
            return;
        }

        return 'x' . $this->extension;
    }

    /**
     * Get formatted phone.
     *
     * @return [[@doctodo return_type:getFormattedPhone]] [[@doctodo return_description:getFormattedPhone]]
     */
    public function getFormattedPhone()
    {
        $parts = [$this->formatPhoneNumber($this->phone)];
        if (isset($this->formattedExtension)) {
            $parts[] = $this->formattedExtension;
        }

        return implode(' ', $parts);
    }

    /**
     * [[@doctodo method_description:formatPhoneNumber]].
     *
     * @param [[@doctodo param_type:phoneNumber]] $phoneNumber [[@doctodo param_description:phoneNumber]]
     *
     * @return [[@doctodo return_type:formatPhoneNumber]] [[@doctodo return_description:formatPhoneNumber]]
     */
    protected function formatPhoneNumber($phoneNumber)
    {
        if (strlen($phoneNumber) > 10) {
            $countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
            $areaCode = substr($phoneNumber, -10, 3);
            $nextThree = substr($phoneNumber, -7, 3);
            $lastFour = substr($phoneNumber, -4, 4);
            $phoneNumber = '+' . $countryCode . ' (' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
        } elseif (strlen($phoneNumber) === 10) {
            $areaCode = substr($phoneNumber, 0, 3);
            $nextThree = substr($phoneNumber, 3, 3);
            $lastFour = substr($phoneNumber, 6, 4);
            $phoneNumber = '(' . $areaCode . ') ' . $nextThree . '-' . $lastFour;
        } elseif (strlen($phoneNumber) === 7) {
            $nextThree = substr($phoneNumber, 0, 3);
            $lastFour = substr($phoneNumber, 3, 4);
            $phoneNumber = $nextThree . '-' . $lastFour;
        }

        return $phoneNumber;
    }
    /**
     * Get registry.
     *
     * @return \yii\db\ActiveRelation
     */
    public function getRegistry()
    {
        return $this->hasOne(Registry::className(), ['id' => 'id']);
    }

    /**
     * Get created user.
     *
     * @return \yii\db\ActiveRelation
     */
    public function getCreatedUser()
    {
        return $this->hasOne(Yii::$app->classes['User'], ['id' => 'created_user_id']);
    }

    /**
     * Get modified user.
     *
     * @return \yii\db\ActiveRelation
     */
    public function getModifiedUser()
    {
        return $this->hasOne(Yii::$app->classes['User'], ['id' => 'modified_user_id']);
    }
}
