<?php
/**
 * @link http://www.infinitecascade.com/
 *
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeGrant\models;

use cascade\models\Registry;
use Yii;

/**
 * ObjectGrant is the model class for table "object_grant".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $determination
 * @property string $start
 * @property string $end
 * @property string $status
 * @property string $ask
 * @property string $award
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
class ObjectGrant extends \cascade\components\types\ActiveRecord
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
        return 'object_grant';
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
            [['title', 'description'], 'required'],
            [['description', 'status'], 'string'],
            [['determination', 'start', 'end'], 'safe'],
            [['ask', 'award'], 'number'],
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
            'determination' => [],
            'start' => [],
            'end' => [],
            'status' => [],
            'ask' => ['formField' => ['fieldConfig' => ['inputGroupPrefix' => '<i class="fa fa-' . Yii::$app->params['currency'] . '"></i>']]],
            'award' => ['formField' => ['fieldConfig' => ['inputGroupPrefix' => '<i class="fa fa-' . Yii::$app->params['currency'] . '"></i>']]],
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
        $settings['fields'][] = ['determination', 'start', 'end'];
        $settings['fields'][] = ['ask', 'award'];
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
            'determination' => 'Determination Date',
            'start' => 'Start Date',
            'end' => 'End Date',
            'status' => 'Status',
            'ask' => 'Ask',
            'award' => 'Award',
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
