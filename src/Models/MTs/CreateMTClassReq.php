<?php

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class CreateMTClassReq extends BaseRequest
{
    /**
     * MT 类别名称
     * @var string
     */
    public string $name;

    /**
     * MT 类别权属者地址，支持任一 Avata 平台内合法链账户地址
     * @var string
     */
    public string $owner;

    /**
     * 自定义链上元数据
     * @var string
     */
    public string $data;

    /**
     * 交易标签， 自定义 key：支持大小写英文字母和汉字和数字，长度 6-12 位，自定义 value：长度限制在 64 位字符，支持大小写字母和数字
     * @var array
     */
    public array $tag;

    /**
     * CreateMTClassReq constructor.
     * @param string $name
     * @param string $owner
     * @param string $data
     * @param array $tag
     * @param string $operation_id
     */
    public function __construct(string $name, string $owner, string $data, string $operation_id, array $tag)
    {
        $this->name = $name;
        $this->owner = $owner;
        $this->data = $data;
        $this->tag = $tag;
        $this->operation_id = $operation_id;
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

    /**
     * @return string
     */
    public function getTagKey(): string
    {
        return "tag";
    }
}