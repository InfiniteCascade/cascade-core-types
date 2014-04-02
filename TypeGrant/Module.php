<?php

namespace cascade\modules\core\TypeGrant;

use Yii;

use cascade\components\types\Relationship;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Grant';
	public $icon = 'fa fa-money';
	public $uniparental = false;
	public $hasDashboard = true;
	public $priority = 1300;

	public $widgetNamespace = 'cascade\modules\core\TypeGrant\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeGrant\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeGrant/migrations');
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
		];
	}

	
	/**
	 * @inheritdoc
	 */
	public function children()
	{
		return [
			'File' => [],
			'Time' => [],
			'Task' => [],
			'Note' => [],
			'Activity' => [],
			'GrantAction' => [],
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