<?php

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class IssueMTReq extends BaseRequest
{
    /**
     * 自定义链上元数据
     * @var string
     */
    public string $data;

    /**
     * MT 数量，不填写数量时，默认发行数量为 1
     * @var int
     */
    public int $amount;

    /**
     * MT 接收者地址，支持任一文昌链合法链账户地址，默认为 MT 类别的权属者地址
     * @var string
     */
    public string $recipient;

    /**
     * 交易标签， 自定义 key：支持大小写英文字母和汉字和数字，长度 6-12 位，自定义 value：长度限制在 64 位字符，支持大小写字母和数字
     * @var array
     */
    public array $tag;

    /**
     * IssueMTReq constructor.
     * @param string $data
     * @param int $amount
     * @param string $recipient
     * @param array $tag
     * @param string $operation_id
     */
    public function __construct(string $data, string $recipient, string $operation_id, int $amount, array $tag)
    {
        $this->amount = $amount;
        $this->recipient = $recipient;
        $this->data = $data;
        $this->tag = $tag;
        $this->operation_id = $operation_id;
    }

}