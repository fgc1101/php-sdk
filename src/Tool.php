<?php
/**
 * Created by Fanguochao
 * User: fgc
 * Date: 2021-09-16
 * Time: 22:22
 * Desc:
 */

namespace Fgc1101\EsignPhpSdk;


class Tool
{
    public $name = null;
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function index(){
        echo "我的名字是：". $this->getName();
    }
}