<?php

namespace cascade\modules\core\TypeTaskSet;

use Yii;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Task Set';
	public $icon = 'fa fa-list';
	public $uniparental = false;
	public $hasDashboard = false;

	public $widgetNamespace = 'cascade\modules\core\TypeTaskSet\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeTaskSet\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeTaskSet/migrations');
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