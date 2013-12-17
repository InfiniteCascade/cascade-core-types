<?php

namespace cascade\modules\core\TypeNote;

use Yii;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Note';
	public $icon = 'fa fa-file-text-o';
	public $uniparental = false;
	public $hasDashboard = false;

	public $widgetNamespace = 'cascade\modules\core\TypeNote\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeNote\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascadeCoreTypes/TypeNote/migrations');
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
			'Time' => [],
			'Task' => [],
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