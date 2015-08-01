<?php
/**
 * @link http://psesd.org/
 *
 * @copyright Copyright (c) 2015 Puget Sound ESD
 * @license http://psesd.org/license/
 */

namespace cascade\modules\core\TypeFile\widgets;

/**
 * DetailList [[@doctodo class_description:cascade\modules\core\TypeFile\widgets\DetailList]].
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
        if ($model->can('read')) {
            return [
                'downloadLink' => ['class' => 'list-group-item-heading', 'tag' => 'h5'],
            ];
        } else {
            return [
                'descriptor' => ['class' => 'list-group-item-heading', 'tag' => 'h5'],
            ];
        }
    }
}
