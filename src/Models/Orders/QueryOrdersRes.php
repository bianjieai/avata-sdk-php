<?php
/**
 *
 * User: yu
 * Date: 2023/1/30
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Models\Orders;


class QueryOrdersRes
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
     * @var array 购买能量值和业务费列表
     * @order_id    string  订单流水号 required
     * @status      string  订单状态，success 充值成功 / failed 充值失败 / pending 正在充值 required
     * 订单状态说明：
        status 为 pending（正在充值），请等待充值完成
        status 为 success（充值成功），能量值/业务费充值成功
        status 为 failed（充值失败），说明该交易执行失败。请在业务侧做容错处理
        可以参考接口返回的 message（订单失败的错误描述信息） 对业务接口的请求参数做适当调整后，使用「新的 Order ID 」重新发起业务接口请求
     * @message     string  提示信息
     * @account     string  链账户地址, 调用「批量购买能量值」接口不展示此字段
     * @amount      string  充值金额，为整数元金额；单位：分, 调用「批量购买能量值」接口不展示此字段
     * @number      string  充值的数量，充值 gas 该值单位为 ugas，充值业务费单位为分, 调用「批量购买能量值」接口不展示此字段
     * @create_time string  创建时间（UTC 时间）required
     * @update_time string  最后操作时间（UTC 时间）required
     * @order_type  string  订单类型，gas / business required
     */
    public $order_infos = [];

    /**
     * QueryOrdersRes constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach($data as $key => $value){
            $this->{$key} = $value;
        }
    }
}