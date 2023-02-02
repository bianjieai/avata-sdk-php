<?php

namespace Bianjieai\AvataSdkPhp\Models\MTs;

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class CreateMTClassReq extends BaseRequest
{
    /**
     * MT 类别名称
     * @var string
     */
    public $name;

    /**
     * MT 类别权属者地址，支持任一 Avata 平台内合法链账户地址
     * @var string
     */
    public $owner;

    /**
     * 自定义链上元数据
     * @var string
     */
    public $data;

    /**
     * CreateMTClassReq constructor.
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
    public function getNameKey(): string
    {
        return "name";
    }

    /**
     * @return string
     */
    public function getOwnerKey(): string
    {
        return "owner";
    }

    /**
     * @return string
     */
    public function getDataKey(): string
    {
        return "data";
    }
}