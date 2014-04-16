<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeInvoice;

use Yii;

use cascade\components\types\Relationship;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Invoice';
	public $icon = 'fa fa-money';
	public $uniparental = true;
	public $hasDashboard = true;
	public $priority = 2150;

	public $widgetNamespace = 'cascade\modules\core\TypeInvoice\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeInvoice\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeInvoice/migrations');
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
			'Agreement' => [
				'type' => Relationship::HAS_ONE
			],
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
			'Time' => [],
];
	}

	
	/**
	 * @inheritdoc
	 */
	public function taxonomies()
	{
		return [];
	}

	public function getInheritParentAccess()
	{
		return true;
	}
}