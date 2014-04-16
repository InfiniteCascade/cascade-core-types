<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeGrantAction;

use Yii;

use cascade\components\types\Relationship;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Grant Action';
	public $icon = 'fa fa-sun-o';
	public $uniparental = true;
	public $hasDashboard = false;
	public $priority = 10;

	public $widgetNamespace = 'cascade\modules\core\TypeGrantAction\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeGrantAction\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeGrantAction/migrations');
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
			'Grant' => [],
		];
	}

	
	/**
	 * @inheritdoc
	 */
	public function children()
	{
		return [
			'Note' => [],
			'File' => [],
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