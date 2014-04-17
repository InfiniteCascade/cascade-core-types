<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeEvent;

use Yii;

use cascade\components\types\Relationship;

/**
 * Module [@doctodo write class description for Module]
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Module extends \cascade\components\types\Module
{
	/**
	 * @inheritdoc
	 */
	protected $_title = 'Event';
	/**
	 * @inheritdoc
	 */
	public $icon = 'fa fa-calendar';
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
	public $priority = 2100;

	/**
	 * @inheritdoc
	 */
	public $widgetNamespace = 'cascade\modules\core\TypeEvent\widgets';
	/**
	 * @inheritdoc
	 */
	public $modelNamespace = 'cascade\modules\core\TypeEvent\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeEvent/migrations');
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
			'Grant' => [],
			'Project' => [],
		];
	}

	
	/**
	 * @inheritdoc
	 */
	public function children()
	{
		return [
			'Task' => [],
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