<?php
/**
 *
 * User: yu
 * Date: 2023/1/30
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Orders;


use Bianjieai\AvataSdkPhp\Models\BaseRequest;

class CreateOrdersReq extends BaseRequest
{
    /**
     * @var string 链账户地址 required
     */
    public $account = "";

    /**
     * @var string 购买金额 ，只能购买整数元金额；单位：分 required
     */
    public $amount = "";

    /**
     * @var string 充值类型：gas：能量值；business：业务费 required
     */
    public $order_type = "";

    /**
     * @var string 自定义订单流水号，必需且仅包含数字、下划线及英文字母大/小写
     */
    public $order_id = "";

    /**
     * CreateOrdersReq constructor.
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