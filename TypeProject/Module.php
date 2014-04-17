<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeProject;

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
	protected $_title = 'Project';
	/**
	 * @inheritdoc
	 */
	public $icon = 'fa fa-briefcase';
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
	public $priority = 1400;

	/**
	 * @inheritdoc
	 */
	public $widgetNamespace = 'cascade\modules\core\TypeProject\widgets';
	/**
	 * @inheritdoc
	 */
	public $modelNamespace = 'cascade\modules\core\TypeProject\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeProject/migrations');
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
			'Individual' => [],
			'Account' => [],
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