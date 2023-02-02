<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class BurnMTReq extends BaseRequest
{
    /**
     * 销毁的数量
     * @var int
     */
    public $amount;
    /**
     * BurnMTReq constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @return string
     */
    public function getAmountKey(): string
    {
        return "amount";
    }
}