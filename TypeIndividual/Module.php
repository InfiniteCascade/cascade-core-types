<?php

namespace cascade\modules\core\TypeIndividual;

use Yii;

use cascade\components\types\Relationship;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Individual';
	public $icon = 'fa fa-user';
	public $uniparental = false;
	public $hasDashboard = true;
	public $priority = 110;

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
		$widgets = parent::widgets();
		$widgets['EmbeddedIndividualBrowse']['section'] = Yii::$app->collectors['sections']->getOne('_side');
		return $widgets;
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
			'PostalAddress' => [],
			'EmailAddress' => [],
			'PhoneNumber' => [],
			'WebAddress' => [],
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