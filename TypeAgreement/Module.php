<?php

namespace cascade\modules\core\TypeAgreement;

use Yii;

use cascade\components\types\Relationship;

class Module extends \cascade\components\types\Module
{
	protected $_title = 'Agreement';
	public $icon = 'fa fa-exchange';
	public $uniparental = false;
	public $hasDashboard = true;
	public $priority = 1900;
	public $searchWeight = 0.7;

	public $widgetNamespace = 'cascade\modules\core\TypeAgreement\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeAgreement\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeAgreement/migrations');
	}

	public function setup() {
		$results = [true];
		if (!empty($this->primaryModel)) {
			$primaryAccount = Yii::$app->gk->primaryAccount;
			if ($primaryAccount) {
				$results[] = $this->objectTypeModel->setRole(['system_id' => 'viewer'], $primaryAccount, true);
			}
		}
		return min($results);
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
			'Note' => [],
			'Time' => [],
			'Task' => [],
			'Invoice' => [],
];
	}

	
	/**
	 * @inheritdoc
	 */
	public function taxonomies()
	{
		return [
			[
				'name' => 'Individual Role',
				'models' => [\cascade\models\Relation::className()],
				'modules' => [self::className()],
				'systemId' => 'ic_agreement_individual_role',
				'systemVersion' => 1.0,
				'multiple' => false,
				'parentUnique' => true,
				'required' => true,
				'initialTaxonomies' => [
					'client' => 'Client',
					'staff' => 'Staff',
				]
			]
		];
	}

}