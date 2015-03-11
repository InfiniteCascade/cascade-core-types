<?php
/**
 * @link http://teal.blue/
 *
 * @copyright Copyright (c) 2015 Teal Software
 * @license http://teal.blue/license/
 */

namespace cascade\modules\core\TypeInvoice;

use cascade\components\types\Relationship;
use Yii;

/**
 * Module [[@doctodo class_description:cascade\modules\core\TypeInvoice\Module]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Module extends \cascade\components\types\Module
{
    /**
     * @inheritdoc
     */
    protected $_title = 'Invoice';
    /**
     * @inheritdoc
     */
    public $icon = 'fa fa-money';
    /**
     * @inheritdoc
     */
    public $uniparental = true;
    /**
     * @inheritdoc
     */
    public $hasDashboard = true;
    /**
     * @inheritdoc
     */
    public $priority = 2150;

    /**
     * @inheritdoc
     */
    public $widgetNamespace = 'cascade\modules\core\TypeInvoice\widgets';
    /**
     * @inheritdoc
     */
    public $modelNamespace = 'cascade\modules\core\TypeInvoice\models';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeInvoice/migrations');
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
            'Agreement' => [
                'type' => Relationship::HAS_ONE,
            ],
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
];
    }

    /**
     * @inheritdoc
     */
    public function taxonomies()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getInheritParentAccess()
    {
        return true;
    }
}
