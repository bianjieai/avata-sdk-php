<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class QueryMTReq extends BaseRequest
{
    /**
     * @var string MT 类别 ID
     */
    public $class_id = "";

    /**
     * @var string MT ID
     */
    public $mt_id = "";

    /**
     * QueryMTReq constructor.
     * @param string $class_id
     * @param string $mt_id
     */
    public function __construct(string $class_id, string $mt_id)
    {
        $this->class_id = $class_id;
        $this->mt_id = $mt_id;
    }
}