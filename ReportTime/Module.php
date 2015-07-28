<?php
/**
 * @link http://canis.io/
 *
 * @copyright Copyright (c) 2015 Canis
 * @license http://canis.io/license/
 */

namespace cascade\modules\core\ReportTime;

use cascade\components\reports\Module as ReportModule;

/**
 * Module [[@doctodo class_description:cascade\modules\core\ReportTime\Module]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Module extends ReportModule
{
    /**
     * @inheritdoc
     */
    protected $_title = 'Time';
    /**
     * @inheritdoc
     */
    public $icon = 'fa fa-clock-o';

    public function getDescription() {
        return 'Lists recorded time';
    }

    public function getObjectTypes() {
        return ['Time', 'Invoice'];
    }
}
