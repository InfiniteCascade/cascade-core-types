<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\ReportTime;

use Yii;
use cascade\components\reports\Module as ReportModule;
use infinite\helpers\ArrayHelper;

/**
 * Module [@doctodo write class description for Module]
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Module extends ReportModule 
{
	/**
	 * @inheritdoc
	 */
	protected $_title = 'Time Invoice';
	/**
	 * @inheritdoc
	 */
	public $icon = 'fa fa-clock-o';
}
?>