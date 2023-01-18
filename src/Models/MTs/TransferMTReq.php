<?php

use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class TransferMTReq extends BaseRequest
{
    /**
     * 转移的数量（默认为 1 ）
     * @var int
     */
    public int $amount;

    /**
     * MT 类别接收者地址，支持任一 Avata 内合法链账户地址
     * @var string
     */
    public string $recipient;

    /**
     * 交易标签， 自定义 key：支持大小写英文字母和汉字和数字，长度 6-12 位，自定义 value：长度限制在 64 位字符，支持大小写字母和数字
     * @var array
     */
    public array $tag;

    /**
     * TransferMTReq constructor.
     * @param int $amount
     * @param string $recipient
     * @param array $tag
     * @param string $operation_id
     */
    public function __construct(string $recipient, string $operation_id, int $amount, array $tag)
    {
        $this->amount = $amount;
        $this->recipient = $recipient;
        $this->tag = $tag;
        $this->operation_id = $operation_id;
    }

}