<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeTask;

use Yii;

use cascade\components\types\Relationship;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Task';
	public $icon = 'fa fa-check';
	public $hasDashboard = false;
	public $uniparental = false;
	public $priority = 2300;

	public $widgetNamespace = 'cascade\modules\core\TypeTask\widgets';
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
			'Individual' => [],
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
		return [];
	}
}