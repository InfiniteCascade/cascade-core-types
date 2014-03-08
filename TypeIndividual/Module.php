<?php

namespace cascade\modules\core\TypeIndividual;

use Yii;

use cascade\models\Registry;
use cascade\components\types\Relationship;

class Module extends \cascade\components\types\Module
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

	public function behaviors()
	{
		return array_merge(parent::behaviors(), [
			'Authority' => [
				'class' => 'cascade\\components\\security\\AuthorityBehavior'
			]
		]);
	}

	public function setup() {
		$results = [true];
		if (!empty($this->primaryModel)) {
			$primaryAccount = Yii::$app->gk->primaryAccount;
			if ($primaryAccount) {
				$results[] = Yii::$app->gk->allow(null, null, $primaryAccount, $this->primaryModel);
			}
		}
		return min($results);
	}

	public function determineOwner($object)
	{
        return false;
	}
	
	/**
	 * @inheritdoc
	 */
	public function getRequestors($accessingObject, $firstLevel = true)
	{
		$individual = false;
		if ($accessingObject->modelAlias === 'cascade\\models\\User' 
			&& isset($accessingObject->object_individual_id)
		) {
			$individual = Registry::getObject($accessingObject->object_individual_id, false);
		} elseif ($accessingObject->modelAlias === ':Individual\\ObjectIndividual') {
			$individual = $accessingObject;
		}

		if ($individual) {
			$requestors = [$individual->primaryKey];
			foreach ($this->collectorItem->parents as $parentType) {
				if (!empty($parentType->parent->getBehavior('Authority'))) {
					if (($parentRequestors = $parentType->parent->getRequestors($individual, false)) && !empty($parentRequestors)) {
						$requestors = array_merge($requestors, $parentRequestors);
					}
				}
			}
			return $requestors;
		}
		return false;
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