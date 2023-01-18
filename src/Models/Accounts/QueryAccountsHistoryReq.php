<?php
/**
 *
 * User: yu
 * Date: 2023/1/17
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Accounts;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class QueryAccountsHistoryReq extends BaseRequest
{
    /**
     * @var string 游标，默认为 0
     */
    public $offset = "0";

    /**
     * @var string 每页记录数，默认为 10，上限为 50
     */
    public $limit = "10";

    /**
     * @var string 链账户地址
     */
    public $account = "";

    /**
     * @var string 功能模块, Enum: "nft" "mt"
     */
    public $module = "";

    /**
     * @var string 操作类型，仅 module 不为空时有效，默认为 "all"。
     * module = nft 时，可选：issue_class / transfer_class / mint / edit / transfer / burn；
     * module = mt 时，可选： issue_class / transfer_class / issue / mint / edit / transfer / burn
     */
    public $operation = "";

    /**
     * @var string Tx Hash
     */
    public $tx_hash = "";

    /**
     * @var string 日期范围 - 开始，yyyy-MM-dd（UTC 时间）
     */
    public $start_date = "";

    /**
     * @var string 日期范围 - 结束，yyyy-MM-dd（UTC 时间）
     */
    public $end_date = "";

    /**
     * @var string 排序规则：DATE_ASC / DATE_DESC
     */
    public $sort_by = "";

    /**
     * QueryAccountsHistoryReq constructor.
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
    public function toArray(): array
    {
        return array_filter((array)$this);
    }
}