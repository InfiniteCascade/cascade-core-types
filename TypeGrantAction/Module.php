<?php
/**
 * @link http://teal.blue/
 *
 * @copyright Copyright (c) 2015 Teal Software
 * @license http://teal.blue/license/
 */

namespace cascade\modules\core\TypeGrantAction;

use Yii;

/**
 * Module [[@doctodo class_description:cascade\modules\core\TypeGrantAction\Module]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Module extends \cascade\components\types\Module
{
    /**
     * @inheritdoc
     */
    protected $_title = 'Grant Action';
    /**
     * @inheritdoc
     */
    public $icon = 'fa fa-sun-o';
    /**
     * @inheritdoc
     */
    public $uniparental = true;
    /**
     * @inheritdoc
     */
    public $hasDashboard = false;
    /**
     * @inheritdoc
     */
    public $priority = 10;

    /**
     * @inheritdoc
     */
    public $widgetNamespace = 'cascade\modules\core\TypeGrantAction\widgets';
    /**
     * @inheritdoc
     */
    public $modelNamespace = 'cascade\modules\core\TypeGrantAction\models';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeGrantAction/migrations');
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
            'Grant' => [],
        ];
    }

    /**
     * @inheritdoc
     */
    public function children()
    {
        return [
            'Note' => [],
            'File' => [],
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
