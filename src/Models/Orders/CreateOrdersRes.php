<?php
/**
 *
 * User: yu
 * Date: 2023/1/30
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Orders;


class CreateOrdersRes
{
    /**
     * @var string 交易流水号（用户发起交易时传入的交易流水号)
     */
    public $order_id = "";

    /**
     * CreateOrdersRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->order_id = $data["order_id"];
    }
}