<?php
/**
 * @link http://canis.io/
 *
 * @copyright Copyright (c) 2015 Canis
 * @license http://canis.io/license/
 */

namespace cascade\modules\core\TypeFile;

use canis\base\exceptions\HttpException;
use Yii;

/**
 * Module [[@doctodo class_description:cascade\modules\core\TypeFile\Module]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Module extends \cascade\components\types\Module
{
    /**
     * @inheritdoc
     */
    protected $_title = 'File';
    /**
     * @inheritdoc
     */
    public $icon = 'fa fa-paperclip';
    /**
     * @inheritdoc
     */
    public $uniparental = false;
    /**
     * @inheritdoc
     */
    public $hasDashboard = false;
    /**
     * @inheritdoc
     */
    public $priority = 2300;
    /**
     * @inheritdoc
     */
    public $widgetNamespace = 'cascade\modules\core\TypeFile\widgets';
    /**
     * @inheritdoc
     */
    public $modelNamespace = 'cascade\modules\core\TypeFile\models';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeFile/migrations');
    }

    /**
     * @inheritdoc
     */
    public function subactions()
    {
        return [
            'download' => [$this, 'actionDownload'],
        ];
    }

    /**
     * [[@doctodo method_description:actionDownload]].
     *
     * @param [[@doctodo param_type:event]] $event [[@doctodo param_description:event]]
     *
     * @throws HttpException [[@doctodo exception_description:HttpException]]
     */
    public function actionDownload($event)
    {
        $results = $event->object->serve();
        if (!$results || !empty($results['error'])) {
            $errorMessage = isset($results['error']) ? $results['error'] : 'Unknown error';
            throw new HttpException(500, $errorMessage);
        }
        $event->handled = true;
    }

    /**
     * @inheritdoc
     */
    public function widgets()
    {
        return parent::widgets();
    }

    /**
     * Get create verb.
     *
     * @param [[@doctodo param_type:object]] $object [[@doctodo param_description:object]]
     *
     * @return [[@doctodo return_type:getCreateVerb]] [[@doctodo return_description:getCreateVerb]]
     */
    public function getCreateVerb($object)
    {
        return new \canis\base\language\Verb('upload');
    }

    /**
     * @inheritdoc
     */
    public function getUpdateVerb($object)
    {
        return new \canis\base\language\Verb('upload');
    }

    /**
     * @inheritdoc
     */
    public function parents()
    {
        return [
            'Project' => [],
            'Account' => [],
            'Individual' => [],
            'Time' => [],
            'Note' => [],
            'Task' => [],
        ];
    }

    /**
     * @inheritdoc
     */
    public function children()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function taxonomies()
    {
        return [];
    }
}
