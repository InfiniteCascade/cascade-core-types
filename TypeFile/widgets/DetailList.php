<?php

namespace cascade\modules\core\TypeFile\widgets;

class DetailList extends \cascade\components\web\widgets\base\DetailList
{
	public function contentTemplate($model)
	{
		return ['downloadLink' => ['class' => 'list-group-item-heading', 'tag' => 'h5']];
	}
}
