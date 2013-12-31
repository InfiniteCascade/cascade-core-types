<?php

namespace cascade\modules\core\TypePostalAddress;

use Yii;

use cascade\components\types\Relationship;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Postal Address';
	public $icon = 'fa fa-envelope';
	public $uniparental = true;
	public $hasDashboard = false;
	public $priority = 2100;

	public $widgetNamespace = 'cascade\modules\core\TypePostalAddress\widgets';
	public $modelNamespace = 'cascade\modules\core\TypePostalAddress\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypePostalAddress/migrations');
	}

	/**
	 * @inheritdoc
	 */
	public function widgets()
	{
		$widgets = parent::widgets();
		$widgets['ChildrenPostalAddressBrowse']['section'] = Yii::$app->collectors['sections']->getOne('_side');
		return $widgets;
	}

	
	/**
	 * @inheritdoc
	 */
	public function parents()
	{
		return [
			'Account' => ['taxonomy' => 'ic_address_type'],
			'Individual' => ['taxonomy' => 'ic_address_type'],
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
		return [
			[
				'name' => 'Address Type',
				'models' => [\cascade\models\Relation::className()],
				'modules' => [self::className()],
				'systemId' => 'ic_address_type',
				'systemVersion' => 1.0,
				'multiple' => true,
				'parentUnique' => true,
				'required' => true,
				'initialTaxonomies' => [
					'billing' => 'Billing Address',
					'shipping' => 'Shipping Address',
				]
			]
		];
	}
}