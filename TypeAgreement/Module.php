<?php

namespace cascade\modules\core\TypeAgreement;

use Yii;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Agreement';
	public $icon = 'fa fa-exchange';
	public $uniparental = false;
	public $hasDashboard = true;

	public $widgetNamespace = 'cascade\modules\core\TypeAgreement\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeAgreement\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeAgreement/migrations');
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
			'File' => ['uniqueChild' => true],
			'Note' => ['uniqueChild' => true],
			'Time' => ['uniqueChild' => true],
			'TaskSet' => ['uniqueChild' => true],
			'Invoice' => ['uniqueChild' => true],
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