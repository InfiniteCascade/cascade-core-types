<?php
/**
 * @link http://teal.blue/
 *
 * @copyright Copyright (c) 2015 Teal Software
 * @license http://teal.blue/license/
 */

namespace cascade\modules\core\TypeEmailAddress\widgets;

/**
 * DetailList [[@doctodo class_description:cascade\modules\core\TypeEmailAddress\widgets\DetailList]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class DetailList extends \cascade\components\web\widgets\base\DetailList
{
    /**
     * @var [[@doctodo var_type:renderContentTemplate]] [[@doctodo var_description:renderContentTemplate]]
     */
    public $renderContentTemplate = ['mailLink' => ['class' => 'list-group-item-heading', 'tag' => 'h5']];
}
