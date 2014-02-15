<?php

namespace cascade\modules\core\TypeTime\widgets;

use Yii;
use infinite\helpers\ArrayHelper;

class SummaryWidget extends \cascade\components\web\widgets\base\WidgetArea
{
	public $location = 'right';
	public function getGridCellSettings() {
		return [
			'columns' => 4,
			'maxColumns' => 4
		];
	}
	

	public function generateContent()
	{
		$parts = [];
		$parts[] = print_r($this->module->getStats(Yii::$app->request->object), true);
		return implode($parts);
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
