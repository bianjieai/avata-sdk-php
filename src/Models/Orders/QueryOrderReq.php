<?php
/**
 *
 * User: yu
 * Date: 2023/1/30
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Orders;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class QueryOrderReq extends BaseRequest
{
    /**
     * @var string 自定义订单流水号
     */
    public $order_id = "";

    /**
     * QueryOrderReq constructor.
     * @param string $order_id
     */
    public function __construct(string $order_id)
    {
        $this->order_id = $order_id;
    }
}