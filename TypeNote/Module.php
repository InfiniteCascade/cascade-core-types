<?php

namespace cascade\modules\core\TypeNote;

use Yii;

use cascade\components\types\Relationship;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Note';
	public $icon = 'fa fa-file-text-o';
	public $uniparental = false;
	public $hasDashboard = false;
	public $priority = 2400;

	public $widgetNamespace = 'cascade\modules\core\TypeNote\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeNote\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeNote/migrations');
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
			'Project' => [],
			'Time' => [],
			'Task' => [],
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