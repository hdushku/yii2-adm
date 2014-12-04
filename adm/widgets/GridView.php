<?php

namespace pavlinter\adm\widgets;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * Class GridView
 * @package pavlinter\adm\widgets
 */
class GridView extends \kartik\grid\GridView
{
    public $export = false;

    public $nestable = false;

    public function init()
    {
        parent::init();
        if ($this->nestable === true || is_array($this->nestable)) {
            echo $this->nestableGrid();
        }
    }

    /**
     * @return mixed
     */
    public function nestableGrid()
    {
        if (!is_array($this->nestable)) {
            $this->nestable = [];
        }
        $nestable = ArrayHelper::merge([
            'class' => '\pavlinter\adm\widgets\GridNestable',
            'grid' => $this,
        ], $this->nestable);
        return forward_static_call([$nestable['class'], 'widget'], $nestable);
    }
}