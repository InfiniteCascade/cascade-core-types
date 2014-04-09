<?php

namespace cascade\modules\core\TypeEmailAddress;

use Yii;

use cascade\components\types\Relationship;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Email Address';
	public $icon = 'fa fa-envelope-o';
	public $uniparental = true;
	public $hasDashboard = false;
	public $childSearchWeight = 0.7;
	public $priority = 2200;
	public $primaryAsChild = true;

	public $widgetNamespace = 'cascade\modules\core\TypeEmailAddress\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeEmailAddress\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeEmailAddress/migrations');
	}
	
	public function setup() {
		$results = [parent::setup()];
		if (!empty($this->primaryModel)) {
			$publicGroup = Yii::$app->gk->publicGroup;
			if ($publicGroup) {
				$results[] = $this->objectTypeModel->setRole(['system_id' => 'viewer'], $publicGroup, true);
			}
		}
		return min($results);
	}

	/**
	 * @inheritdoc
	 */
	public function determineOwner($object)
	{
        return false;
	}

	/**
	 * @inheritdoc
	 */
	public function widgets()
	{
		$widgets = parent::widgets();
		$widgets['ChildrenEmailAddressBrowse']['section'] = Yii::$app->collectors['sections']->getOne('_side');
		return $widgets;
	}

	
	/**
	 * @inheritdoc
	 */
	public function parents()
	{
		return [
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