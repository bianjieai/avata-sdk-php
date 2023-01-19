<?php
/**
 *
 * User: yu
 * Date: 2023/1/18
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Classes;


class QueryNFTClassRes
{
    /**
     * @var string NFT 类别 ID
     */
    public $id = "";

    /**
     * @var string NFT 类别名称
     */
    public $name = "";

    /**
     * @var string NFT 类别标识
     */
    public $symbol = "";

    /**
     * @var string NFT 类别描述
     */
    public $description = "";

    /**
     * @var int NFT 类别包含的 NFT 总量
     */
    public $nft_count = 0;

    /**
     * @var string 链外数据链接
     */
    public $uri = "";

    /**
     * @var string 链外数据 Hash
     */
    public $uri_hash = "";

    /**
     * @var string 自定义链上元数据
     */
    public $data = "";

    /**
     * @var string NFT 类别权属者地址
     */
    public $owner = "";

    /**
     * @var string 创建 NFT 类别的 Tx Hash
     */
    public $tx_hash = "";

    /**
     * @var string 创建 NFT 类别的时间戳（UTC 时间）
     */
    public $timestamp = "";

    /**
     * QueryNFTClassRes constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}