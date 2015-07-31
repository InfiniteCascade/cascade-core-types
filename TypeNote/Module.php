<?php
/**
 * @link http://canis.io/
 *
 * @copyright Copyright (c) 2015 Canis
 * @license http://canis.io/license/
 */

namespace cascade\modules\core\TypeNote;

use Yii;

/**
 * Module [[@doctodo class_description:cascade\modules\core\TypeNote\Module]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Module extends \cascade\components\types\Module
{
    /**
     * @inheritdoc
     */
    protected $_title = 'Note';
    /**
     * @inheritdoc
     */
    public $icon = 'fa fa-file-text-o';
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
    public $priority = 2400;
    /**
     * @inheritdoc
     */
    public $widgetNamespace = 'cascade\modules\core\TypeNote\widgets';
    /**
     * @inheritdoc
     */
    public $modelNamespace = 'cascade\modules\core\TypeNote\models';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeNote/migrations');
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
            'Account' => [],
            'Individual' => [],
            'Project' => [],
            'Time' => [],
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
