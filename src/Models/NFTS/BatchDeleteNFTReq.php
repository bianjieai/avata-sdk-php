<?php
/**
 *
 * User: yu
 * Date: 2023/1/20
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\NFTS;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class BatchDeleteNFTReq extends BaseRequest
{
    /**
     * @var string NFT 持有者地址，也是 Tx 签名者地址 required
     */
    public $owner = "";

    /**
     * @var array 销毁的NFT信息 required
     *
     * @class_id string NFT 类别 ID required
     * @nft_id string NFT ID required
     */
    public $nfts = [];

    /**
     * BatchEditNFTReq constructor.
     * @param array $data
     */
    public function __construct(array $data)
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