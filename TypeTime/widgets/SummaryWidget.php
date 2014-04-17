<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeTime\widgets;

use Yii;
use infinite\helpers\ArrayHelper;

/**
 * SummaryWidget [@doctodo write class description for SummaryWidget]
 *
 * @author Jacob Morrison <email@ofjacob.com>
**/
class SummaryWidget extends \cascade\components\web\widgets\base\WidgetArea
{
	public $defaultDecoratorClass = 'cascade\\components\\web\\widgets\\decorator\\BlankDecorator';
	protected $_stats;
	public $location = 'right';

	public function getGridCellSettings() {
		return [
			'columns' => 5,
			'maxColumns' => 6,
			'htmlOptions' => ['class' => 'no-left-padding']
		];
	}


	/**
	* @inheritdoc
	**/
	public function getIsReady()
	{
		return !empty($this->stats['total']);
	}

	public function getStats()
	{
		if (is_null($this->_stats)) {
			$this->_stats = $this->module->getStats(Yii::$app->request->object);
		}
		return $this->_stats;
	}

	/**
	* @inheritdoc
	**/
	public function generateContent()
	{
		if (!empty($this->stats['total'])) {
			return $this->render('summary', ['stats' => $this->stats]);;
		}
		return false;
	}

	public function getModule()
	{
		$method = ArrayHelper::getValue($this->parentWidget->settings, 'queryRole', 'all');
		$relationship = ArrayHelper::getValue($this->parentWidget->settings, 'relationship', false);
		if ($method === 'children') {
			return $relationship->child;
		} elseif ($method === 'parents') {
			return $relationship->parent;
		}
		return false;
	}

}
