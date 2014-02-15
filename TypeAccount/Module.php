<?php

namespace cascade\modules\core\TypeAccount;

use Yii;

use cascade\components\types\Relationship;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Account';
	public $icon = 'fa fa-building-o';
	public $uniparental = false;
	public $hasDashboard = true;
	public $priority = 105;
	public $primaryAsParent = true;

	public $widgetNamespace = 'cascade\modules\core\TypeAccount\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeAccount\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeAccount/migrations');
	}

	public function setup() {
		$results = [true];
		if (!empty($this->primaryModel) AND !empty($this->collectorItem->parents)) {
			$primaryAccount = Yii::$app->gk->primaryAccount;
			if ($primaryAccount) {
				$results[] = Yii::$app->gk->allow(null, null, $primaryAccount, $this->primaryModel);
			}
		}
		return min($results);
	}

	/**
	 * @inheritdoc
	 */
	public function widgets()
	{
		$widgets = parent::widgets();
		$widgets['ParentAccountBrowse']['section'] = Yii::$app->collectors['sections']->getOne('_side');
		return $widgets;
	}

	
	/**
	 * @inheritdoc
	 */
	public function parents()
	{
		return [
			'Account' => [],
		];
	}

	
	/**
	 * @inheritdoc
	 */
	public function children()
	{
		return [
			'Account' => [],
			'Individual' => [],
			'PhoneNumber' => [],
			'PostalAddress' => [],
			'WebAddress' => [],
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