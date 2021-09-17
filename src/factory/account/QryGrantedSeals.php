<?php
/**
 * Created by Fanguochao
 * User: fgc
 * Date: 2021-09-17
 * Time: 17:13
 * Desc:
 */

namespace factory\account;

use factory\request\EsignRequest;
use Fgc1101\EsignPhpSdk\emun\HttpEmun;

class QryGrantedSeals extends EsignRequest implements \JsonSerializable
{
    private $orgId;

    /**
     * QryOrganizationsByOrgId constructor.
     * @param $orgId
     */
    public function __construct($orgId)
    {
        $this->orgId = $orgId;
    }

    /**
     * @return mixed
     */
    public function getOrgId()
    {
        return $this->orgId;
    }

    /**
     * @param mixed $orgId
     */
    public function setOrgId($orgId)
    {
        $this->orgId = $orgId;
    }

    function build()
    {
        $this->setUrl("/v1/organizations/".$this->orgId."/granted/seals");
        $this->setReqType(HttpEmun::GET);
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $json = array();
        foreach ($this as $key => $value) {
            if($value==null||$key=='orgId') {
                continue;
            }
            $json[$key] = $value;
        }
        return $json;
    }
}