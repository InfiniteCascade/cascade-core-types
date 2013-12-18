<?php

namespace cascade\modules\core\TypeIndividual;

use Yii;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Individual';
	public $icon = 'fa fa-user';
	public $uniparental = false;
	public $hasDashboard = true;

	public $widgetNamespace = 'cascade\modules\core\TypeIndividual\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeIndividual\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeIndividual/migrations');
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
			'PostalAddress' => ['uniqueChild' => true],
			'EmailAddress' => ['uniqueChild' => true],
			'PhoneNumber' => ['uniqueChild' => true],
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