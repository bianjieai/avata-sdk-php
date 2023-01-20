<?php
/**
 *
 * User: yu
 * Date: 2023/1/19
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\NFTS;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class BatchTransferNFTReq extends BaseRequest
{
    /**
     * @var string NFT 持有者地址 required
     */
    public $owner = "";

    /**
     * @var array required
     *
     * @nfts 转让的NFT信息
     * @nfts["class_id"] string 类别ID required
     * @nfts["nft_id"] string NFT-ID required
     * @recipient string 接收者地址
     *
     * "data" => [
            [
                [
                    "nfts" => [
                        "class_id" => "<class_id 类别ID>",
                        "nft_id" => "<转让的NFT-ID>"
                    ],
                     "recipient" => "<接收者地址>"
                ]
            ]
    ]
     */
    public $data = [];

    /**
     * @var array 交易标签
     *
     * 自定义 key：支持大小写英文字母和汉字和数字，长度 6-12 位
     * 自定义 value：长度限制在 64 位字符，支持大小写字母和数字
     *
     */
    public $tag = [];

    /**
     * BatchTransferNFTReq constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @return array 转数组
     */
    public function toArray() :array
    {
        return array_filter((array)$this);
    }
}