<?php
/**
 * @link http://psesd.org/
 *
 * @copyright Copyright (c) 2015 Puget Sound ESD
 * @license http://psesd.org/license/
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
