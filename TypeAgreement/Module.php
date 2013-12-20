<?php

namespace cascade\modules\core\TypeAgreement;

use Yii;

use cascade\components\types\Relationship;

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
			'File' => [],
			'Note' => [],
			'Time' => [],
			'TaskSet' => [],
			'Invoice' => [],
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