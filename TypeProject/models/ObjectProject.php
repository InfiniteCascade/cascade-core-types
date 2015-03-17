<?php
/**
 * @link http://canis.io/
 *
 * @copyright Copyright (c) 2015 Canis
 * @license http://canis.io/license/
 */

namespace cascade\modules\core\TypeProject\models;

use cascade\models\Registry;

/**
 * ObjectProject is the model class for table "object_project".
 *
 * @property string $id
 * @property string $owner_user_id
 * @property string $title
 * @property string $description
 * @property string $start
 * @property string $end
 * @property boolean $active
 * @property string $created
 * @property string $created_user_id
 * @property string $modified
 * @property string $modified_user_id
 * @property string $archived
 * @property string $archived_user_id
 * @property User $createdUser
 * @property User $archivedUser
 * @property User $modifiedUser
 * @property Registry $registry
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class ObjectProject extends \cascade\components\types\ActiveRecord
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
        return 'object_project';
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
            [['title'], 'required'],
            [['description'], 'string'],
            [['start', 'end'], 'safe'],
            [['active'], 'boolean'],
            [['id', 'created_user_id', 'modified_user_id', 'archived_user_id'], 'string', 'max' => 36],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function fieldSettings()
    {
        return [
            'title' => [],
            'description' => [],
            'start' => ['formField' => ['type' => 'date']],
            'end' => ['formField' => ['type' => 'date']],
            'active' => ['formField' => ['type' => 'checkBox']],
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
        $settings['fields'][] = ['title'];
        $settings['fields'][] = ['description'];
        $settings['fields'][] = ['start', 'end'];
        if (!$this->isNewRecord) {
            $settings['fields'][] = ['active'];
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
            'title' => 'Title',
            'description' => 'Description',
            'start' => 'Start',
            'end' => 'End',
            'active' => 'Active',
            'created' => 'Created Date',
            'created_user_id' => 'Created by User',
            'modified' => 'Modified Date',
            'modified_user_id' => 'Modified by User',
            'archived' => 'Archived Date',
            'archived_user_id' => 'Archived by User',
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
     * Get archived user.
     *
     * @return \yii\db\ActiveRelation
     */
    public function getArchivedUser()
    {
        return $this->hasOne(Yii::$app->classes['User'], ['id' => 'archived_user_id']);
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
