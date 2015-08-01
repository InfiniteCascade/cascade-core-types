<?php
/**
 * @link http://psesd.org/
 *
 * @copyright Copyright (c) 2015 Puget Sound ESD
 * @license http://psesd.org/license/
 */

namespace cascade\modules\core\TypeProject;

use Yii;

/**
 * Module [[@doctodo class_description:cascade\modules\core\TypeProject\Module]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Module extends \cascade\components\types\Module
{
    /**
     * @inheritdoc
     */
    protected $_title = 'Project';
    /**
     * @inheritdoc
     */
    public $icon = 'fa fa-briefcase';
    /**
     * @inheritdoc
     */
    public $uniparental = false;
    /**
     * @inheritdoc
     */
    public $hasDashboard = true;
    /**
     * @inheritdoc
     */
    public $priority = 1400;

    /**
     * @inheritdoc
     */
    public $widgetNamespace = 'cascade\modules\core\TypeProject\widgets';
    /**
     * @inheritdoc
     */
    public $modelNamespace = 'cascade\modules\core\TypeProject\models';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeProject/migrations');
    }

    /**
     * @inheritdoc
     */
    public function widgets()
    {
        return parent::widgets();
    }

    /**
     * @inheritdoc
     */
    public function parents()
    {
        return [
            'Individual' => [],
            'Account' => [],
        ];
    }

    /**
     * @inheritdoc
     */
    public function children()
    {
        return [
            'File' => [],
            'Note' => [],
            'Time' => [],
            'Task' => [],
];
    }

    /**
     * @inheritdoc
     */
    public function taxonomies()
    {
        return [];
    }
}
