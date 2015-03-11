<?php
/**
 * @link http://teal.blue/
 *
 * @copyright Copyright (c) 2015 Teal Software
 * @license http://teal.blue/license/
 */

namespace cascade\modules\core\TypeWebAddress\models;

use cascade\models\Registry;
use teal\helpers\Html;

/**
 * ObjectWebAddress is the model class for table "object_web_address".
 *
 * @property string $id
 * @property string $title
 * @property string $url
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
class ObjectWebAddress extends \cascade\components\types\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $descriptorField = 'title';

    /**
     * @inheritdoc
     */
    public function getDescriptor()
    {
        if (!empty($this->title)) {
            return $this->title;
        } else {
            return $this->url;
        }
    }

    /**
     * Get link.
     *
     * @return [[@doctodo return_type:getWebLink]] [[@doctodo return_description:getWebLink]]
     */
    public function getWebLink()
    {
        return Html::a($this->descriptor, $this->url, ['target' => '_blank']);
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'object_web_address';
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
            [['url'], 'required'],
            [['id', 'created_user_id', 'modified_user_id'], 'string', 'max' => 36],
            [['title'], 'string', 'max' => 255],
            [['url'], 'string', 'max' => 500],
            [['url'], 'url'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fieldSettings()
    {
        return [
            'title' => [],
            'url' => [
                'formField' => [
                    'htmlOptions' => ['placeholder' => 'e.g. http://www.google.com'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function formSettings($name, $settings = [])
    {
        return ['fields' => [['url'], ['title']]];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'url' => 'URL',
            'created' => 'Created Date',
            'created_user_id' => 'Created by User',
            'modified' => 'Modified Date',
            'modified_user_id' => 'Modified by User',
        ];
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
