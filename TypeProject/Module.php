<?php

namespace cascade\modules\core\TypeProject;

use Yii;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Project';
	public $icon = 'fa fa-briefcase';
	public $uniparental = false;
	public $hasDashboard = true;

	public $widgetNamespace = 'cascade\modules\core\TypeProject\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeProject\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascadeCoreTypes/TypeProject/migrations');
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
			'File' => ['uniqueChild' => true],
			'Note' => ['uniqueChild' => true],
			'Time' => ['uniqueChild' => true],
			'TaskSet' => ['uniqueChild' => true],
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