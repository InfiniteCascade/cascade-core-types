<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeEmailAddress\widgets;

class DetailList extends \cascade\components\web\widgets\base\DetailList
{
	public $renderContentTemplate = ['mailLink' => ['class' => 'list-group-item-heading', 'tag' => 'h5']];
}
