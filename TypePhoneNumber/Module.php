<?php

namespace cascade\modules\core\TypePhoneNumber;

use Yii;

use cascade\components\types\Relationship;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Phone Number';
	public $icon = 'fa fa-phone';
	public $uniparental = true;
	public $hasDashboard = false;
	public $priority = 2300;

	public $widgetNamespace = 'cascade\modules\core\TypePhoneNumber\widgets';
	public $modelNamespace = 'cascade\modules\core\TypePhoneNumber\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypePhoneNumber/migrations');
	}

	/**
	 * @inheritdoc
	 */
	public function widgets()
	{
		$widgets = parent::widgets();
		$widgets['EmbeddedPhoneNumberBrowse']['section'] = Yii::$app->collectors['sections']->getOne('_side');
		return $widgets;
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