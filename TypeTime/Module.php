<?php

namespace cascade\modules\core\TypeTime;

use Yii;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Time';
	public $icon = 'fa fa-clock-o';
	public $uniparental = false;
	public $hasDashboard = false;

	public $widgetNamespace = 'cascade\modules\core\TypeTime\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeTime\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascadeCoreTypes/TypeTime/migrations');
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