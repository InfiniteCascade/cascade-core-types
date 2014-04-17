<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeFile;

use Yii;

use cascade\components\types\Relationship;
use infinite\base\exceptions\HttpException;

/**
 * Module [@doctodo write class description for Module]
 *
 * @author Jacob Morrison <email@ofjacob.com>
**/
class Module extends \cascade\components\types\Module
{
	protected $_title = 'File';
	public $icon = 'fa fa-paperclip';
	public $uniparental = false;
	public $hasDashboard = false;
	public $priority = 2300;

	public $widgetNamespace = 'cascade\modules\core\TypeFile\widgets';
	public $modelNamespace = 'cascade\modules\core\TypeFile\models';

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		Yii::$app->registerMigrationAlias('@cascade/modules/core/TypeFile/migrations');
	}

	public function subactions()
	{
		return [
			'download' => [$this, 'actionDownload']
		];
	}

	public function actionDownload($event)
	{
		$results = $event->object->serve();
		if (!$results || !empty($results['error'])) {
			$errorMessage = isset($results['error']) ? $results['error'] : 'Unknown error';
			throw new HttpException(500, $errorMessage);
		}
		$event->handled = true;
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
			'Project' => [],
			'Account' => [],
			'Individual' => [],
			'Time' => [],
			'Note' => [],
			'Task' => [],
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