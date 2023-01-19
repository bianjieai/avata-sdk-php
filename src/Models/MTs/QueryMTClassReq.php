<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class QueryMTClassReq extends BaseRequest
{
    /**
     * @var string MT 类别 ID
     */
    public $id = "";

    /**
     * QueryMTClassReq constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

}