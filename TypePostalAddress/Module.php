<?php
/**
 * @link http://canis.io/
 *
 * @copyright Copyright (c) 2015 Canis
 * @license http://canis.io/license/
 */

namespace cascade\modules\core\TypePostalAddress;

use cascade\components\types\Module as TypeModule;
use Yii;

/**
 * Module [[@doctodo class_description:cascade\modules\core\TypePostalAddress\Module]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Module extends TypeModule
{
    /**
     * @inheritdoc
     */
    protected $_title = 'Postal Address';
    /**
     * @inheritdoc
     */
    public $icon = 'fa fa-envelope';
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
    public $priority = 2100;
    /**
     * @inheritdoc
     */
    public $widgetNamespace = 'cascade\modules\core\TypePostalAddress\widgets';
    /**
     * @inheritdoc
     */
    public $modelNamespace = 'cascade\modules\core\TypePostalAddress\models';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::$app->registerMigrationAlias('@cascade/modules/core/TypePostalAddress/migrations');
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
        $widgets['ChildrenPostalAddressBrowse']['section'] = Yii::$app->collectors['sections']->getOne('_side');

        return $widgets;
    }

    /**
     * @inheritdoc
     */
    public function parents()
    {
        return [
            'Account' => ['taxonomy' => 'ic_address_type'],
            'Individual' => ['taxonomy' => 'ic_address_type'],
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
        return [
            [
                'name' => 'Address Type',
                'models' => [\cascade\models\Relation::className()],
                'modules' => [self::className()],
                'systemId' => 'ic_address_type',
                'systemVersion' => 1.0,
                'multiple' => true,
                'parentUnique' => true,
                'required' => true,
                'initialTaxonomies' => [
                    'billing' => 'Billing Address',
                    'shipping' => 'Shipping Address',
                ],
            ],
        ];
    }
}
