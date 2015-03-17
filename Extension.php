<?php
/**
 * @link http://canis.io/
 *
 * @copyright Copyright (c) 2015 Canis
 * @license http://canis.io/license/
 */

namespace cascade\modules\core;

use Yii;

/**
 * Extension [[@doctodo class_description:cascade\modules\core\Extension]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Extension extends \cascade\components\base\ModuleSetExtension
{
    /**
     * Initializes.
     */
    public static function init()
    {
        parent::init();
        Yii::setAlias('@cascade/modules/core', __DIR__);
    }

    /**
     * @inheritdoc
     */
    public static function getModules()
    {
        $m = [];
        $m['TypeAccount'] = [
            'class' => 'cascade\modules\core\TypeAccount\Module',
            'title' => 'Organization',
        ];
        $m['TypeIndividual'] = [
            'class' => 'cascade\modules\core\TypeIndividual\Module',
        ];
        $m['TypePostalAddress'] = [
            'class' => 'cascade\modules\core\TypePostalAddress\Module',
        ];
        $m['TypePhoneNumber'] = [
            'class' => 'cascade\modules\core\TypePhoneNumber\Module',
        ];
        $m['TypeEmailAddress'] = [
            'class' => 'cascade\modules\core\TypeEmailAddress\Module',
        ];
        $m['TypeWebAddress'] = [
            'class' => 'cascade\modules\core\TypeWebAddress\Module',
        ];
        $m['TypeFile'] = [
            'class' => 'cascade\modules\core\TypeFile\Module',
        ];
        $m['TypeNote'] = [
            'class' => 'cascade\modules\core\TypeNote\Module',
        ];
        $m['TypeProject'] = [
            'class' => 'cascade\modules\core\TypeProject\Module',
        ];
        $m['TypeTask'] = [
            'class' => 'cascade\modules\core\TypeTask\Module',
        ];
        $m['TypeTime'] = [
            'class' => 'cascade\modules\core\TypeTime\Module',
        ];
        $m['TypeGrant'] = [
            'class' => 'cascade\modules\core\TypeGrant\Module',
        ];
        $m['TypeGrantAction'] = [
            'class' => 'cascade\modules\core\TypeGrantAction\Module',
        ];
        $m['TypeAgreement'] = [
            'class' => 'cascade\modules\core\TypeAgreement\Module',
        ];
        $m['TypeInvoice'] = [
            'class' => 'cascade\modules\core\TypeInvoice\Module',
        ];
        $m['TypeEvent'] = [
            'class' => 'cascade\modules\core\TypeEvent\Module',
        ];
        $m['ReportTime'] = [
            'class' => 'cascade\modules\core\ReportTime\Module',
        ];
        $m['ToolTimeInvoice'] = [
            'class' => 'cascade\modules\core\ToolTimeInvoice\Module',
        ];

        return $m;
    }
}
