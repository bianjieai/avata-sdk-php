<?php
/**
 *
 * User: yu
 * Date: 2023/1/18
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Classes;


class QueryNFTCLassesRes
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
     * @var array 类别列表
     * @id          NFT 类别 ID
     * @`name`      NFT 类别名称
     * @symbol      NFT 类别标识
     * @nft_count   NFT 类别包含的 NFT 总量
     * @uri         链外数据链接
     * @owner       NFT 类别权属者地址
     * @tx_hash     创建 NFT 类别的 Tx Hash
     * @timestamp   创建 NFT 类别的时间戳（UTC 时间）
     */
    public $classes = [];

    /**
     * QueryNFTCLassesRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}