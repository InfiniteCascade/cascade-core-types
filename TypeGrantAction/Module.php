<?php

namespace cascade\modules\core\TypeGrantAction;

use Yii;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Grant Action';
	public $icon = 'fa fa-sun-o';
	public $uniparental = true;
	public $hasDashboard = false;

	public $widgetNamespace = 'cascade\modules\core\TypeGrantAction\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeGrantAction\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeGrantAction/migrations');
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
			'Grant' => [],
		];
	}

	
	/**
	 * @inheritdoc
	 */
	public function children()
	{
		return [
			'Note' => ['uniqueChild' => true],
			'File' => ['uniqueChild' => true],
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