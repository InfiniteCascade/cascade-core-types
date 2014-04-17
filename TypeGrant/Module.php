<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeGrant;

use Yii;

use cascade\components\types\Relationship;

/**
 * Module [@doctodo write class description for Module]
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Module extends \cascade\components\types\Module
{
	/**
	 * @inheritdoc
	 */
	protected $_title = 'Grant';
	/**
	 * @inheritdoc
	 */
	public $icon = 'fa fa-money';
	/**
	 * @inheritdoc
	 */
	public $uniparental = false;
	/**
	 * @inheritdoc
	 */
	public $hasDashboard = true;
	/**
	 * @inheritdoc
	 */
	public $priority = 1300;

	/**
	 * @inheritdoc
	 */
	public $widgetNamespace = 'cascade\modules\core\TypeGrant\widgets';
	/**
	 * @inheritdoc
	 */
	public $modelNamespace = 'cascade\modules\core\TypeGrant\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeGrant/migrations');
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
			'Time' => [],
			'Task' => [],
			'Note' => [],
			'Activity' => [],
			'GrantAction' => [],
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