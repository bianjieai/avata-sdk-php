<?php
/**
 *
 * User: yu
 * Date: 2023/1/30
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Orders;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class QueryOrdersReq extends BaseRequest
{
    /**
     * @var string 订单状态：success 充值成功 / failed 充值失败 / pending 正在充值
     */
    public $status = "";

    /**
     * @var string 充值订单创建日期范围 - 开始，yyyy-MM-dd（UTC 时间）
     */
    public $start_date = "";

    /**
     * @var string 充值订单创建日期范围 - 结束，yyyy-MM-dd（UTC 时间）
     */
    public $end_date = "";

    /**
     * @var string 排序规则：DATE_ASC / DATE_DESC，默认为 DATE_DESC
     */
    public $sort_by = "";

    /**
     * QueryOrdersReq constructor.
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