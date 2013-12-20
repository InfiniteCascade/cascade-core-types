<?php

namespace cascade\modules\core\TypeTaskSet\modules\TypeTask;

use Yii;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Task';
	public $icon = 'fa fa-check';
	public $uniparental = true;
	public $hasDashboard = false;

	public $widgetNamespace = 'cascade\modules\core\TypeTaskSet\modules\TypeTask\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeTaskSet\modules\TypeTask\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeTaskSet/modules/TypeTask/migrations');
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
			'TaskSet' => [],
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