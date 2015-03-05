<?php
/**
 * @link http://www.infinitecascade.com/
 *
 * @copyright Copyright (c) 2014 Infinite Cascade
 * @license http://www.infinitecascade.com/license/
 */

namespace cascade\modules\core\TypeTask\widgets;

use yii\web\AssetBundle;

/**
 * TaskAsset [[@doctodo class_description:cascade\modules\core\TypeTask\widgets\TaskAsset]].
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 *
 * @since 2.0
 */
class TaskAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@cascade/modules/core/TypeTask/assets';
    /**
     * @inheritdoc
     */
    public $css = ['css/cascade.object.task.css'];
    /**
     * @inheritdoc
     */
    public $js = ['js/cascade.object.task.js'];
    /**
     * @inheritdoc
     */
    public $depends = [
        'cascade\components\web\assetBundles\AppAsset',
    ];
}
