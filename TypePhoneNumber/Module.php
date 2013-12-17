<?php

namespace cascade\modules\core\TypePhoneNumber;

use Yii;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Phone Number';
	public $icon = 'fa fa-phone';
	public $uniparental = true;
	public $hasDashboard = false;

	public $widgetNamespace = 'cascade\modules\core\TypePhoneNumber\widgets';
	public $modelNamespace = 'cascade\modules\core\TypePhoneNumber\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascadeCoreTypes/TypePhoneNumber/migrations');
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