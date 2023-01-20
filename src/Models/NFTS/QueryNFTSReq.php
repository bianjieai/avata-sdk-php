<?php
/**
 *
 * User: yu
 * Date: 2023/1/20
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\NFTS;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class QueryNFTSReq extends BaseRequest
{
    /**
     * @var string NFT ID
     */
    public $id = "";

    /**
     * @var string NFT 名称，支持模糊查询
     */
    public $name = "";

    /**
     * @var string NFT 类别 ID
     */
    public $class_id = "";

    /**
     * @var string NFT 持有者地址
     */
    public $owner = "";

    /**
     * @var string 创建 NFT 的 Tx Hash
     */
    public $tx_hash = "";

    /**
     * @var string NFT 状态：active / burned，默认为 active
     */
    public $status = "";

    /**
     * @var string NFT 创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
     */
    public $start_date = "";

    /**
     * @var string NFT 创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
     */
    public $end_date = "";

    /**
     * @var string 排序规则：DATE_ASC / DATE_DESC
     */
    public $sort_by = "";

    /**
     * QueryNFTSReq constructor.
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