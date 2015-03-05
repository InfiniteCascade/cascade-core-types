<?php
/**
 * @link http://www.infinitecascade.com/
 *
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
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
