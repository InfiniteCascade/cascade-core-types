<?php
/**
 * @link http://canis.io/
 *
 * @copyright Copyright (c) 2015 Canis
 * @license http://canis.io/license/
 */

namespace cascade\modules\core\TypeTask;

use Yii;

/**
 * Module [[@doctodo class_description:cascade\modules\core\TypeTask\Module]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Module extends \cascade\components\types\Module
{
    /**
     * @inheritdoc
     */
    protected $_title = 'Task';
    /**
     * @inheritdoc
     */
    public $icon = 'fa fa-check';
    /**
     * @inheritdoc
     */
    public $hasDashboard = false;
    /**
     * @inheritdoc
     */
    public $uniparental = false;
    /**
     * @inheritdoc
     */
    public $priority = 2300;

    /**
     * @inheritdoc
     */
    public $widgetNamespace = 'cascade\modules\core\TypeTask\widgets';
    /**
     * @inheritdoc
     */
    public $modelNamespace = 'cascade\modules\core\TypeTask\models';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeTask/migrations');
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
            'Project' => [],
            'Individual' => [
                'taxonomy' => 'ic_task_individual_role',
            ],
            'Grant' => [],
            'Event' => [],
            'Time' => [],
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
];
    }

    /**
     * @inheritdoc
     */
    public function taxonomies()
    {
        return [
            [
                'name' => 'Role',
                'models' => [\cascade\models\Relation::className()],
                'modules' => [self::className()],
                'systemId' => 'ic_task_individual_role',
                'systemVersion' => 1.0,
                'multiple' => false,
                'parentUnique' => true,
                'required' => true,
                'initialTaxonomies' => [
                    'assignee' => 'Assigned To',
                    'requestor' => 'Requestor',
                ],
            ],
        ];
    }
}
