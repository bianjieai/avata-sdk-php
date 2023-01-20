<?php
/**
 *
 * User: yu
 * Date: 2023/1/20
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\NFTS;


class QueryNFTHistoryRes
{
    /**
     * @var int 游标，默认为 0
     */
    public $offset = 0;

    /**
     * @var int 每页记录数，默认为 10，上限为 50
     */
    public $limit = 10;

    /**
     * @var int 总记录数
     */
    public $total_count = 0;

    /**
     * @var array 操作记录列表
     *
     * @tx_hash    NFT 操作的 Tx Hash
     * @operation  NFT 操作类型 Enum: "mint" "edit" "transfer" "burn"
     * @signer     Tx 签名者地址
     * @recipient  NFT 接收者地址
     * @timestamp  NFT 操作时间戳（UTC 时间）
     */
    public $operation_records = [];

    /**
     * QueryNFTHistoryRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}