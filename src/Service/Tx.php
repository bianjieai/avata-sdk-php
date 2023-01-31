<?php
/**
 *
 * User: yu
 * Date: 2023/1/31
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Service;


use Bianjieai\AvataSdkPhp\Models\BaseResponse;
use Bianjieai\AvataSdkPhp\Models\ExceptionRes;
use Bianjieai\AvataSdkPhp\Models\HttpRes;
use Bianjieai\AvataSdkPhp\Models\Tx\QueryTxQueueReq;
use Bianjieai\AvataSdkPhp\Models\Tx\QueryTxReq;
use Bianjieai\AvataSdkPhp\Utils\Utils;

class Tx
{
    /**
     * 上链交易结果查询
     * 根据在接口请求时自定义的 Operation ID ，查询相关的链上操作结果。
     * 每笔交易会产生唯一的 Operation ID，根据 Operation ID，可以查询具体的交易结果，包含交易状态、交易信息及交易详情。
     * Operation ID 的值为原 Task ID 对应的值，建议程序中尽早将 Task ID 替换为 Operation ID。
     *
     * 当前支持查询当月及上个月的交易结果，其它月历史数据已归档，暂不支持查询对应结果。
     *
     * 注意：
     * 若查询出的链上操作结果 status 为 2（失败），请在业务侧做容错处理。
     * 可以参考接口返回的 message（交易失败的错误描述信息） 对 NFT / MT / 业务接口的请求参数做适当调整后
     * 使用「新的 Operation ID 」重新发起 NFT / MT / 业务接口请求。
     *
     * @param QueryTxReq $request
     * @return BaseResponse
     */
    public function QueryTx(QueryTxReq $request) :BaseResponse
    {
        if ($request->operation_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "operation_id is required");
        }
        try {
            $tx = Utils::HttpGet(sprintf("/tx/%s", $request->operation_id), []);
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($tx);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($tx->getStatusCode(), ""));
        return $response;
    }

    /**
     * 上链交易排队状态查询
     *
     * 应用平台方可调用此接口查看 Avata 平台的当前链交易排队情况以及待处理的交易数量，辅助业务上链时间的选择决策
     * 也可以指定 Operation ID 来查询对应交易的排队状态
     *
     * @param QueryTxQueueReq $request
     * @return BaseResponse
     */
    public function QueryTxQueue(QueryTxQueueReq $request) :BaseResponse
    {
        try {
            $tx = Utils::HttpPost("/tx/queue/info", [
                $request->getOperationIDKey() => $request->operation_id,
            ]);
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($tx);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($tx->getStatusCode(), ""));
        return $response;
    }
}