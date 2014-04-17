<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypePhoneNumber;

use Yii;

use cascade\components\types\Relationship;

/**
 * Module [@doctodo write class description for Module]
 *
 * @author Jacob Morrison <email@ofjacob.com>
**/
class Module extends \cascade\components\types\Module
{
	/**
	 * @inheritdoc
	 */
	protected $_title = 'Phone Number';
	/**
	 * @inheritdoc
	 */
	public $icon = 'fa fa-phone';
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
	public $childSearchWeight = 0.8;
	/**
	 * @inheritdoc
	 */
	public $priority = 2300;
	/**
	 * @inheritdoc
	 */
	public $primaryAsChild = true;

	/**
	 * @inheritdoc
	 */
	public $widgetNamespace = 'cascade\modules\core\TypePhoneNumber\widgets';
	/**
	 * @inheritdoc
	 */
	public $modelNamespace = 'cascade\modules\core\TypePhoneNumber\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypePhoneNumber/migrations');
	}

	/**
	* @inheritdoc
	**/
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
		$widgets['ChildrenPhoneNumberBrowse']['section'] = Yii::$app->collectors['sections']->getOne('_side');
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