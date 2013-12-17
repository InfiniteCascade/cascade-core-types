<?php

namespace cascade\modules\core\TypeAccount;

use Yii;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Account';
	public $icon = 'fa fa-building-o';
	public $uniparental = false;
	public $hasDashboard = true;

	public $widgetNamespace = 'cascade\modules\core\TypeAccount\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeAccount\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascadeCoreTypes/TypeAccount/migrations');
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
		];
	}

	
	/**
	 * @inheritdoc
	 */
	public function children()
	{
		return [
			'Account' => ['uniqueChild' => true],
			'Individual' => ['uniqueChild' => true],
			'PhoneNumber' => ['uniqueChild' => true],
			'PostalAddress' => ['uniqueChild' => true],
			'WebAddress' => ['uniqueChild' => true],
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