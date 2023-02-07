<?php
/**
 *
 * User: yu
 * Date: 2023/1/30
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Service;


use Bianjieai\AvataSdkPhp\Exception\Exception;
use Bianjieai\AvataSdkPhp\Models\Orders\BatchCreateOrderReq;
use Bianjieai\AvataSdkPhp\Models\Orders\BatchCreateOrderRes;
use Bianjieai\AvataSdkPhp\Models\Orders\CreateOrdersReq;
use Bianjieai\AvataSdkPhp\Models\Orders\CreateOrdersRes;
use Bianjieai\AvataSdkPhp\Models\Orders\QueryOrderReq;
use Bianjieai\AvataSdkPhp\Models\Orders\QueryOrderRes;
use Bianjieai\AvataSdkPhp\Models\Orders\QueryOrdersReq;
use Bianjieai\AvataSdkPhp\Models\Orders\QueryOrdersRes;
use Bianjieai\AvataSdkPhp\Utils\Utils;

class Orders extends Base
{
    /**
     * 购买能量值/业务费
     *
     * 通过 Avata 平台创建的 DDC 链账户，可以通过此接口进行能量值和业务费的购买
     * 如果您是 BSN 文昌链-天舟平台非托管模式项目，可以使用该项目参数，通过此接口进行能量值的购买
     *
     * @param CreateOrdersReq $request
     * @return CreateOrdersRes
     * @throws Exception
     */
    public function CreateOrder(CreateOrdersReq $request): CreateOrdersRes
    {
        if ($request->account == "") {
            throw new Exception("account is required");
        }
        if ($request->amount == "") {
            throw new Exception("amount is required");
        }
        if ($request->order_type == "") {
            throw new Exception("order_type is required");
        }
        if ($request->order_id == "") {
            throw new Exception("order_type is required");
        }
        try {
            $orders = Utils::HttpPost("/orders", $request->toArray());
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($orders);
        return new CreateOrdersRes($data["data"]);
    }

    /**
     * 查询能量值/业务费购买结果列表
     *
     * 根据查询条件，展示与应用相关的能量值/业务费购买信息
     * 当前支持查询当月及上个月的购买结果，其它月历史数据已归档，暂不支持查询对应结果
     * 若查询出的订单状态 status 为 failed（充值失败），说明该交易执行失败。请在业务侧做容错处理
     * 可以参考接口返回的 message（订单失败的错误描述信息） 对业务接口的请求参数做适当调整后，使用「新的 Order ID 」重新发起业务接口请求
     *
     * @param QueryOrdersReq $request
     * @return QueryOrdersRes
     * @throws Exception
     */
    public function QueryOrders(QueryOrdersReq $request): QueryOrdersRes
    {
        try {
            $orders = Utils::HttpGet("/orders", $request->toArray());
        }catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($orders);
        return new QueryOrdersRes($data["data"]);
    }

    /**
     * 查询能量值/业务费购买结果
     *
     * 根据指定的 OrderID，查询相关的订单信息
     * 当前支持查询当月及上个月的购买结果，其它月历史数据已归档，暂不支持查询对应结果
     * 若查询出的订单状态 status 为 failed（充值失败），说明该交易执行失败。请在业务侧做容错处理
     * 可以参考接口返回的 message（订单失败的错误描述信息） 对业务接口的请求参数做适当调整后，使用「新的 Order ID 」重新发起业务接口请求
     *
     * @param QueryOrderReq $request
     * @return QueryOrderRes
     * @throws Exception
     */
    public function QueryOrder(QueryOrderReq $request): QueryOrderRes
    {
        if ($request->order_id == "") {
            throw new Exception("order_id is required");
        }
        try {
            $order = Utils::HttpGet(sprintf("/orders/%s", $request->order_id), []);
        }catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($order);
        return new QueryOrderRes($data["data"]);
    }

    /**
     * 批量购买能量值
     *
     * 如果您是 BSN 文昌链-天舟平台非托管模式项目，可以使用该项目参数，通过此接口对多地址进行能量值的批量购买
     *
     * @param BatchCreateOrderReq $request
     * @return BatchCreateOrderRes
     * @throws Exception
     */
    public function BatchCreateOrder(BatchCreateOrderReq $request): BatchCreateOrderRes
    {
        if ($request->order_id == "") {
            throw new Exception("order_id is required");
        }
        if (count($request->list) < 1) {
            throw new Exception("list is required");
        }

        try {
            $order = Utils::HttpPost("/orders/batch", $request->toArray());
        }catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($order);
        return new BatchCreateOrderRes($data["data"]);
    }
}