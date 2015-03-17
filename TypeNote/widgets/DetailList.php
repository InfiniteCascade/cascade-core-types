<?php
/**
 * @link http://canis.io/
 *
 * @copyright Copyright (c) 2015 Canis
 * @license http://canis.io/license/
 */

namespace cascade\modules\core\TypeNote\widgets;

/**
 * DetailList [[@doctodo class_description:cascade\modules\core\TypeNote\widgets\DetailList]].
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
        $template = parent::contentTemplate($model);
        $template['note'] = ['class' => 'expanded-only expanded-pre list-group-label-block'];

        return $template;
    }
}
