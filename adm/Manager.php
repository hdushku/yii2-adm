<?php

/**
 * @copyright Copyright &copy; Pavels Radajevs <pavlinter@gmail.com>, 2014
 * @package yii2-adm
 */

namespace pavlinter\adm;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Manager is used in order to create models.
 */
class Manager extends \yii\base\Component
{
    /**
     * @param string $name
     * @param array $params
     * @return mixed|object
     */
    public function __call($name, $params)
    {
        $property = (false !== ($query = strpos($name, 'Query'))) ? mb_substr($name, 6, -5) : mb_substr($name, 6);
        $property = lcfirst($property) . 'Class';
        if ($query) {
            $method = ArrayHelper::remove($params, '0', 'find');
            return forward_static_call_array([$this->$property, $method], $params);
        }
        if (isset($this->$property)) {
            $config = [];
            if (isset($params[0]) && is_array($params[0])) {
                $config = $params[0];
            }
            $config['class'] = $this->$property;
            return Yii::createObject($config);
        }
        return parent::__call($name, $params);
    }
}