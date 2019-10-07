<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 10/4/2019
 * Time: 9:52 AM.
 */

namespace EasyStore;


trait HasOptions
{
    /**
     * @return mixed
     */
    public function getOptions($key = null)
    {
        return Options::getOptions($key);
    }

    /**
     * @param mixed $options
     * @return HasOptions
     */
    public function setOptions($options)
    {
        Options::setOptions($options);
        return $this;
    }
}
