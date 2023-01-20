<?php
/**
 *
 * User: yu
 * Date: 2023/1/20
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\NFTS;


class QueryNFTSRes
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
     * @var array NFT列表
     * @id          NFT ID required
     * @`name`      NFT 名称 required
     * @class_id    NFT 类别ID required
     * @class_name    NFT 类别名称 required
     * @class_symbol    NFT 类别标识
     * @uri    链外数据链接
     * @owner    NFT 持有者地址 required
     * @status    NFT 状态：active / burned required
     * @tx_hash    NFT 发行 Tx Hash required
     * @timestamp    NFT 发行时间戳（UTC 时间）required
     */
    public $nfts = [];

    /**
     * QueryNFTCLassesRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach($data as $key => $value){
            $this->{$key} = $value;
        }
    }
}