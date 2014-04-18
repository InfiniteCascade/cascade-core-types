<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeEmailAddress;

use Yii;

use cascade\components\types\Relationship;
use cascade\components\types\Module as TypeModule;

/**
 * Module [@doctodo write class description for Module]
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class Module extends TypeModule
{
	/**
	 * @inheritdoc
	 */
	protected $_title = 'Email Address';
	/**
	 * @inheritdoc
	 */
	public $icon = 'fa fa-envelope-o';
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
	public $childSearchWeight = 0.7;
	/**
	 * @inheritdoc
	 */
	public $priority = 2200;
	/**
	 * @inheritdoc
	 */
	public $widgetNamespace = 'cascade\modules\core\TypeEmailAddress\widgets';
	/**
	 * @inheritdoc
	 */
	public $modelNamespace = 'cascade\modules\core\TypeEmailAddress\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeEmailAddress/migrations');
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

	public function getPrimaryAsChild(TypeModule $parent)
    {
        return true;
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