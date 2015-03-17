<?php
/**
 * @link http://canis.io/
 *
 * @copyright Copyright (c) 2015 Canis
 * @license http://canis.io/license/
 */

namespace cascade\modules\core\TypeWebAddress\widgets;

/**
 * DetailList [[@doctodo class_description:cascade\modules\core\TypeWebAddress\widgets\DetailList]].
 *
 * @author Jacob Morrison <email@ofjacob.com>
 */
class DetailList extends \cascade\components\web\widgets\base\DetailList
{
    /**
     * @inheritdoc
     */
    public function contentTemplate($model)
    {
        return [
            'webLink' => ['class' => 'list-group-item-heading', 'tag' => 'h5'],
        ];
    }
}
