<?php

namespace cascade\modules\core\TypeTime;

use Yii;

use cascade\components\types\Relationship;

use infinite\base\language\Noun;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Tracked Time';
	public $icon = 'fa fa-clock-o';
	public $uniparental = false;
	public $hasDashboard = false;
	public $priority = 2400;

	public $widgetNamespace = 'cascade\modules\core\TypeTime\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeTime\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeTime/migrations');
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
		];
	}

	
	/**
	 * @inheritdoc
	 */
	public function taxonomies()
	{
		return [];
	}

	public function getTitle() {
		if (!is_object($this->_title)) {
			$this->_title = new Noun($this->_title, ['plural' => $this->_title]);
		}
		return $this->_title;
	}
}