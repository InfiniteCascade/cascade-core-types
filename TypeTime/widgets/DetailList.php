<?php

namespace cascade\modules\core\TypeTime\widgets;

class DetailList extends \cascade\components\web\widgets\base\DetailList
{
	public function contentTemplate($model)
	{
		return [
			'descriptor' => ['class' => 'list-group-item-heading', 'tag' => 'h5'],
			'description' => [],
		];
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
