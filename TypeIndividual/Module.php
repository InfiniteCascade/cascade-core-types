<?php

namespace cascade\modules\core\TypeIndividual;

use Yii;

use cascade\components\types\Relationship;
use cascade\components\security\AuthorityInterface;

class Module extends \cascade\components\types\Module implements AuthorityInterface
{
	protected $_title = 'Individual';
	public $icon = 'fa fa-user';
	public $uniparental = false;
	public $hasDashboard = true;
	public $priority = 110;
	public $primaryAsChild = true;

	public $widgetNamespace = 'cascade\\modules\\core\\TypeIndividual\\widgets';
	public $modelNamespace = 'cascade\\modules\\core\\TypeIndividual\\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeIndividual/migrations');
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
	public function getRequestors()
	{
		
	}

	public function getRequestorTypes()
	{
		
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
			'PostalAddress' => [],
			'EmailAddress' => [],
			'PhoneNumber' => [],
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