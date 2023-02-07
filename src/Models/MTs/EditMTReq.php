<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class EditMTReq extends BaseRequest
{
    /**
     * 自定义链上元数据
     * @var string
     */
    public $data;

    /**
     * EditMTReq constructor.
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
    public function getDataKey(): string
    {
        return "data";
    }
}