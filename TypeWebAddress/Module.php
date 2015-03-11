<?php
/**
 * @link http://teal.blue/
 *
 * @copyright Copyright (c) 2015 Teal Software
 * @license http://teal.blue/license/
 */

namespace cascade\modules\core\TypeWebAddress;

use cascade\components\types\Module as TypeModule;
use Yii;

/**
 * Module [[@doctodo class_description:cascade\modules\core\TypeWebAddress\Module]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Module extends TypeModule
{
    /**
     * @inheritdoc
     */
    protected $_title = 'Web Address';
    /**
     * @inheritdoc
     */
    public $icon = 'fa fa-external-link';
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
    public $priority = 2600;
    /**
     * @inheritdoc
     */
    public $childSearchWeight = .2;

    /**
     * @inheritdoc
     */
    public $widgetNamespace = 'cascade\modules\core\TypeWebAddress\widgets';
    /**
     * @inheritdoc
     */
    public $modelNamespace = 'cascade\modules\core\TypeWebAddress\models';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeWebAddress/migrations');
    }

    /**
     * @inheritdoc
     */
    public function setup()
    {
        $results = [parent::setup()];
        if (!empty($this->primaryModel)) {
            $publicGroup = Yii::$app->gk->publicGroup;
            if ($publicGroup) {
                $results[] = $this->objectTypeModel->setRole(['system_id' => 'viewer'], $publicGroup, true);
            }
        }

        return min($results);
    }

    /**
     * @inheritdoc
     */
    public function getPrimaryAsChild(TypeModule $parent)
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function determineOwner($object)
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function widgets()
    {
        $widgets = parent::widgets();
        $widgets['ChildrenWebAddressBrowse']['section'] = Yii::$app->collectors['sections']->getOne('_side');

        return $widgets;
    }

    /**
     * @inheritdoc
     */
    public function parents()
    {
        return [
            'Account' => [],
            'Individual' => [],
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
