<?php

namespace cascade\modules\core\TypeTime\widgets;

class DetailList extends \cascade\components\web\widgets\base\DetailList
{
	public $pageSize = 8;

	public function contentTemplate($model)
	{
		if ($model->can('read')) {
			return [
				'descriptor' => ['class' => 'list-group-item-heading', 'tag' => 'h5'],
				'description' => [],
			];
		} else {
			return [
				'descriptor' => ['class' => 'list-group-item-heading', 'tag' => 'h5'],
			];
		}
	}


	public function getWidgetAreas()
	{
		return [
			[
				'class' => 'cascade\modules\core\TypeTime\widgets\SummaryWidget'
			]
		];
	}
}
