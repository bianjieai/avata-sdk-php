<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class QueryMTBalanceReq extends BaseRequest
{
    /**
     * @var string MT ID
     */
    public $id = "";

    /**
     * QueryMTBalanceReq constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @return string 转字符串
     */
    public function toString(): string
    {
        return http_build_query(array_filter((array)$this), '', '&');
    }

    /**
     * @return array 转数组
     */
    public function toArray(): array
    {
        return array_filter((array)$this);
    }
}