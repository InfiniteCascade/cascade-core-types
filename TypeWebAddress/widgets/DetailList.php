<?php
/**
 * @link http://www.infinitecascade.com/
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeWebAddress\widgets;

/**
 * DetailList [@doctodo write class description for DetailList]
 *
 * @author Jacob Morrison <email@ofjacob.com>
**/
class DetailList extends \cascade\components\web\widgets\base\DetailList
{
	/**
	 * @var __var_renderContentTemplate_type__ __var_renderContentTemplate_description__
	 */
	public $renderContentTemplate = ['link' => ['class' => 'list-group-item-heading', 'tag' => 'h5']];
}
