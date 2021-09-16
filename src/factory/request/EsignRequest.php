<?php
/**
 * Created by Fanguochao
 * User: fgc
 * Date: 2021-09-16
 * Time: 22:49
 * Desc:
 */

namespace factory\request;

use Fgc1101\EsignPhpSdk\comm\HttpHelper;



abstract class EsignRequest
{
    private $reqType;
    private $url;

    public function execute(){
        try {
            $reflectionClass = new \ReflectionClass($this);
        } catch (\ReflectionException $e) {
        }
        $build=$reflectionClass->getMethod("build");
        $build->invoke($this);
        $paramStr=json_encode($this,JSON_UNESCAPED_SLASHES);
        if($paramStr=="[]"){
            $paramStr='{}';
        }
        return HttpHelper::doCommHttp( $this->reqType, $this->url,$paramStr);
    }

    /**
     * @return mixed
     */
    public function getReqType()
    {
        return $this->reqType;
    }

    /**
     * @param mixed $reqType
     */
    public function setReqType($reqType)
    {
        $this->reqType = $reqType;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    abstract function build();
}