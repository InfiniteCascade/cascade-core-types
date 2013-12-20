<?php

namespace cascade\modules\core\TypeEvent;

use Yii;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Event';
	public $icon = 'fa fa-calendar';
	public $uniparental = false;
	public $hasDashboard = true;

	public $widgetNamespace = 'cascade\modules\core\TypeEvent\widgets';
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
			'TaskSet' => [],
			'Note' => [],
			'File' => [],
			'Individual' => [],
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