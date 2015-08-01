<?php
/**
 * @link http://psesd.org/
 *
 * @copyright Copyright (c) 2015 Puget Sound ESD
 * @license http://psesd.org/license/
 */

namespace cascade\modules\core\TypeAgreement;

use Yii;

/**
 * Module [[@doctodo class_description:cascade\modules\core\TypeAgreement\Module]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Module extends \cascade\components\types\Module
{
    /**
     * @inheritdoc
     */
    protected $_title = 'Agreement';
    /**
     * @inheritdoc
     */
    public $icon = 'fa fa-exchange';
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
    public $priority = 1900;
    /**
     * @inheritdoc
     */
    public $searchWeight = 0.7;

    /**
     * @inheritdoc
     */
    public $widgetNamespace = 'cascade\modules\core\TypeAgreement\widgets';
    /**
     * @inheritdoc
     */
    public $modelNamespace = 'cascade\modules\core\TypeAgreement\models';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeAgreement/migrations');
    }

    /**
     * @inheritdoc
     */
    public function setup()
    {
        $results = [true];
        if (!empty($this->primaryModel)) {
            $primaryAccount = Yii::$app->gk->primaryAccount;
            if ($primaryAccount) {
                $results[] = $this->objectTypeModel->setRole(['system_id' => 'viewer'], $primaryAccount, true);
            }
        }

        return min($results);
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
            'Account' => [
                'taxonomy' => 'ic_agreement_account_role',
            ],
            'Individual' => [
                'taxonomy' => 'ic_agreement_individual_role',
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
            'Task' => [],
            'Invoice' => [],
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
                'systemId' => 'ic_agreement_account_role',
                'systemVersion' => 1.1,
                'multiple' => false,
                'parentUnique' => false,
                'required' => true,
                'initialTaxonomies' => [
                    'contractor' => 'Contractor',
                    'contractee' => 'Contractee',
                    'subcontractor' => 'Subcontractor',
                ],
            ],
            [
                'name' => 'Role',
                'models' => [\cascade\models\Relation::className()],
                'modules' => [self::className()],
                'systemId' => 'ic_agreement_individual_role',
                'systemVersion' => 1.0,
                'multiple' => true,
                'parentUnique' => false,
                'required' => true,
                'initialTaxonomies' => [
                    'primary_staff' => 'Primary Staff Member',
                    'primary_client_contact' => 'Primary Client Contact',
                    'billing_contact' => 'Billing Contact',
                    'technical_contact' => 'Technical Contact',
                    'other_contact' => 'Other Contact',
                ],
            ],
        ];
    }
}
