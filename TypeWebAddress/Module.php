<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeWebAddress;

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
	protected $_title = 'Web Address';
	/**
	 * @inheritdoc
	 */
	public $icon = 'fa fa-external-link';
	/**
	 * @inheritdoc
	 */
	public $uniparental = true;
	/**
	 * @inheritdoc
	 */
	public $hasDashboard = false;
	/**
	 * @inheritdoc
	 */
	public $priority = 2600;
	/**
	 * @inheritdoc
	 */
	public $primaryAsChild = true;
	/**
	 * @inheritdoc
	 */
	public $childSearchWeight = .2;

	/**
	 * @inheritdoc
	 */
	public $widgetNamespace = 'cascade\modules\core\TypeWebAddress\widgets';
	/**
	 * @inheritdoc
	 */
	public $modelNamespace = 'cascade\modules\core\TypeWebAddress\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeWebAddress/migrations');
	}
		
	/**
	* @inheritdoc
	 */
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
		$widgets['ChildrenWebAddressBrowse']['section'] = Yii::$app->collectors['sections']->getOne('_side');
		return $widgets;
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