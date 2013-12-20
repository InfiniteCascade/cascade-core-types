<?php

namespace cascade\modules\core\TypeFile;

use Yii;

use cascade\components\types\Relationship;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'File';
	public $icon = 'fa fa-paperclip';
	public $uniparental = false;
	public $hasDashboard = false;

	public $widgetNamespace = 'cascade\modules\core\TypeFile\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeFile\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeFile/migrations');
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
			'Account' => [],
			'Individual' => [],
			'Time' => [],
			'Note' => [],
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