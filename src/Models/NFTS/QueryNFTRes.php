<?php
/**
 *
 * User: yu
 * Date: 2023/1/20
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\NFTS;


class QueryNFTRes
{
    /**
     * @var string NFT ID
     */
    public $id = "";

    /**
     * @var string NFT 名称
     */
    public $name = "";

    /**
     * @var string NFT 类别 ID
     */
    public $class_id = "";

    /**
     * @var string NFT 类别名称
     */
    public $class_name = "";

    /**
     * @var string NFT 类别标识
     */
    public $class_symbol = "";

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
     * @var string NFT 持有者地址
     */
    public $owner = "";

    /**
     * @var string NFT 状态：active / burned
     */
    public $status = "";

    /**
     * @var string NFT 发行 Tx Hash
     */
    public $tx_hash = "";

    /**
     * @var string NFT 发行时间戳（UTC 时间）
     */
    public $timestamp = "";

    /**
     * QueryNFTRes constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach($data as $key => $value){
            $this->{$key} = $value;
        }
    }
}