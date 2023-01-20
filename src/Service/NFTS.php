<?php
/**
 *
 * User: yu
 * Date: 2023/1/9
 * Email: <Tianyu@bianjie.ai>
 */
namespace Bianjieai\AvataSdkPhp\Service;

use Bianjieai\AvataSdkPhp\Models\BaseResponse;
use Bianjieai\AvataSdkPhp\Models\ExceptionRes;
use Bianjieai\AvataSdkPhp\Models\HttpRes;
use Bianjieai\AvataSdkPhp\Models\NFTS\BatchCreateNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\BatchDeleteNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\BatchEditNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\BatchTransferNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\CreateNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\DeleteNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\EditNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\QueryNFTHistoryReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\QueryNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\QueryNFTSReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\TransferNFTReq;
use Bianjieai\AvataSdkPhp\Utils\Utils;

class NFTS extends Base
{
    /**
     * 发行 NFT
     *
     * NFT 是链上唯一的、可识别的资产，由用户自己在区块链上铸造一个NFT
     *
     * @param CreateNFTReq $request
     * @return BaseResponse
     */
    public function CreateNFT(CreateNFTReq $request) :BaseResponse
    {
        if ($request->class_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "class_id is required");
        }
        if ($request->name == "") {
            return new BaseResponse(BaseResponse::$code_error, "name is required");
        }
        if ($request->operation_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "operation_id is required");
        }

        try {
            $classes = Utils::HttpPost(sprintf("/nft/nfts/%s", $request->class_id), $request->toArray());
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($classes);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($classes->getStatusCode(), ""));
        return $response;
    }

    /**
     * 转让 NFT
     *
     * 注意：在调用此接口时，「Avata」API 服务平台「允许」应用平台方将 NFT 转让给「任一文昌链合法链账户地址」
     *
     * @param TransferNFTReq $request
     * @return BaseResponse
     */
    public function TransferNFT(TransferNFTReq $request) :BaseResponse
    {
        if ($request->class_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "class_id is required");
        }
        if ($request->owner == "") {
            return new BaseResponse(BaseResponse::$code_error, "owner is required");
        }
        if ($request->nft_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "nft_id is required");
        }
        if ($request->recipient == "") {
            return new BaseResponse(BaseResponse::$code_error, "recipient is required");
        }
        if ($request->operation_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "operation_id is required");
        }

        try {
            $nft = Utils::HttpPost(sprintf("/nft/nft-transfers/%s/%s/%s", $request->class_id, $request->owner, $request->nft_id), $request->toArray());
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($nft);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($nft->getStatusCode(), ""));
        return $response;
    }

    /**
     * 编辑 NFT
     *
     * 对于已经发布至链上的 NFT ，可根据需求来编辑链上 NFT 的相关信息，如名称、元数据等信息。
     * 注意：只可编辑自己链账户所拥有的 NFT 信息，对于由自己发行，但已经归属于其它链账户地址的 NFT，不可进行编辑。
     *
     * @param EditNFTReq $request
     * @return BaseResponse
     */
    public function EditNFT(EditNFTReq $request) :BaseResponse
    {
        if ($request->class_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "class_id is required");
        }
        if ($request->owner == "") {
            return new BaseResponse(BaseResponse::$code_error, "owner is required");
        }
        if ($request->nft_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "nft_id is required");
        }
        if ($request->name == "") {
            return new BaseResponse(BaseResponse::$code_error, "name is required");
        }
        if ($request->operation_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "operation_id is required");
        }

        try {
            $nft = Utils::HttpPatch(sprintf("/nft/nfts/%s/%s/%s", $request->class_id, $request->owner, $request->nft_id), $request->toArray());
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($nft);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($nft->getStatusCode(), ""));
        return $response;
    }

    /**
     * 销毁 NFT
     *
     * 用户可以销毁自己链账户地址中拥有的 NFT
     * NFT 销毁后，链上依然会保留与该 NFT 相关的链上历史记录信息，但不可再对该 NFT 进行任何的操作。
     *
     * @param DeleteNFTReq $request
     * @return BaseResponse
     */
    public function DeleteNFT(DeleteNFTReq $request) :BaseResponse
    {
        if ($request->class_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "class_id is required");
        }
        if ($request->owner == "") {
            return new BaseResponse(BaseResponse::$code_error, "owner is required");
        }
        if ($request->nft_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "nft_id is required");
        }
        if ($request->operation_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "operation_id is required");
        }
        try {
            $nft = Utils::HttpDelete(sprintf("/nft/nfts/%s/%s/%s", $request->class_id, $request->owner, $request->nft_id), $request->toArray());
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($nft);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($nft->getStatusCode(), ""));
        return $response;
    }

    /**
     * 批量发行 NFT
     *
     * NFT 是链上唯一的、可识别的资产，由用户自己在区块链上批量铸造 NFT，单次请求批量发行数量上限10。
     * 使用批量发行 NFT 接口时，需保证此交易体小于 7000 字节，如果交易体数据很难估算准确，建议避免使用批量发行方法。
     * 由于批量发行方法对网络平滑出块影响比较大，后续其 GAS 费有可能被调高以不鼓励批量发行方法的使用。
     *
     * @param BatchCreateNFTReq $request
     * @return BaseResponse
     */
    public function BatchCreateNFT(BatchCreateNFTReq $request) :BaseResponse
    {
        if ($request->class_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "class_id is required");
        }
        if ($request->name == "") {
            return new BaseResponse(BaseResponse::$code_error, "name is required");
        }
        if (count($request->recipients) < 1) {
            return new BaseResponse(BaseResponse::$code_error, "recipients is required");
        }
        if ($request->operation_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "operation_id is required");
        }

        try {
            $nfts = Utils::HttpPost(sprintf("/nft/batch/nfts/%s", $request->class_id), $request->toArray());
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($nfts);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($nfts->getStatusCode(), ""));
        return $response;
    }

    /**
     * 批量转让 NFT
     *
     * NFT 的拥有者可以调用该接口批量转让其 NFT，批量转让的 NFT 数量上限为 10
     * 使用批量转让 NFT 接口时，需保证此交易体小于 7000 字节，如果交易体数据很难估算准确，建议避免使用批量发行方法
     * 由于批量发行方法对网络平滑出块影响比较大，后续其 GAS 费有可能被调高以不鼓励批量发行方法的使用
     *
     * 注意：在调用此接口时，「Avata」API 服务平台「允许」应用平台方将 NFT 转让给「任一文昌链合法链账户地址」
     *
     * @param BatchTransferNFTReq $request
     * @return BaseResponse
     */
    public function BatchTransferNFT(BatchTransferNFTReq $request) :BaseResponse
    {
        if ($request->owner == "") {
            return new BaseResponse(BaseResponse::$code_error, "owner is required");
        }
        if ($request->operation_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "operation_id is required");
        }
        if (count($request->data) < 1) {
            return new BaseResponse(BaseResponse::$code_error, "data is required");
        }

        try {
            $nfts = Utils::HttpPost(sprintf("/nft/batch/nft-transfers/%s", $request->owner), $request->toArray());
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($nfts);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($nfts->getStatusCode(), ""));
        return $response;
    }

    /**
     * 批量编辑 NFT
     *
     * NFT 的拥有者可以调用该接口批量编辑其 NFT。其中，可编辑的参数为 name 、uri 和 data，批量编辑的 NFT 数量上限为 10
     * 使用批量编辑 NFT 接口时，需保证此交易体小于 7000 字节，如果交易体数据很难估算准确，建议避免使用批量发行方法
     * 由于批量发行方法对网络平滑出块影响比较大，后续其 GAS 费有可能被调高以不鼓励批量发行方法的使用。
     *
     * 注意：只可编辑自己链账户所拥有的 NFT ，对于由自己发行，但已经归属于其它链账户地址的 NFT，不可进行编辑
     *
     * @param BatchEditNFTReq $request
     * @return BaseResponse
     */
    public function BatchEditNFT(BatchEditNFTReq $request) :BaseResponse
    {
        if ($request->owner == "") {
            return new BaseResponse(BaseResponse::$code_error, "owner is required");
        }
        if ($request->operation_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "operation_id is required");
        }
        if (count($request->nfts) < 1) {
            return new BaseResponse(BaseResponse::$code_error, "nfts is required");
        }

        try {
            $nfts = Utils::HttpPatch(sprintf("/nft/batch/nfts/%s", $request->owner), $request->toArray());
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($nfts);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($nfts->getStatusCode(), ""));
        return $response;
    }

    /**
     * 批量销毁 NFT
     *
     * NFT 的拥有者可以调用该接口批量销毁其 NFT，批量销毁的 NFT 数量上限为 10
     * 使用批量销毁 NFT 接口时，需保证此交易体小于 7000 字节，如果交易体数据很难估算准确，建议避免使用批量发行方法
     * 由于批量发行方法对网络平滑出块影响比较大，后续其 GAS 费有可能被调高以不鼓励批量发行方法的使用
     *
     * 注意：NFT 销毁后，链上依然会保留与该 NFT 相关的链上历史记录信息，但不可再对该 NFT 进行任何的操作
     *
     * @param BatchDeleteNFTReq $request
     * @return BaseResponse
     */
    public function BatchDeleteNFT(BatchDeleteNFTReq $request) :BaseResponse
    {
        if ($request->owner == "") {
            return new BaseResponse(BaseResponse::$code_error, "owner is required");
        }
        if ($request->operation_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "operation_id is required");
        }
        if (count($request->nfts) < 1) {
            return new BaseResponse(BaseResponse::$code_error, "nfts is required");
        }

        try {
            $nfts = Utils::HttpDelete(sprintf("/nft/batch/nfts/%s", $request->owner), $request->toArray());
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($nfts);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($nfts->getStatusCode(), ""));
        return $response;
    }

    /**
     * 查询 NFT
     *
     * 根据查询条件，展示 Avata 平台内的 NFT 列表
     *
     * @param QueryNFTSReq $request
     * @return BaseResponse
     */
    public function QueryNFTS(QueryNFTSReq $request) :BaseResponse
    {
        try {
            $nfts = Utils::HttpGet("/nft/nfts", $request->toArray());
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($nfts);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($nfts->getStatusCode(), ""));
        return $response;
    }

    /**
     * 查询 NFT 详情
     *
     * 根据查询条件，展示 Avata 平台内的 NFT 对应的详情信息
     *
     * @param QueryNFTReq $request
     * @return BaseResponse
     */
    public function QueryNFT(QueryNFTReq $request) :BaseResponse
    {
        if ($request->class_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "class_id is required");
        }
        if ($request->nft_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "nft_id is required");
        }

        try {
            $nft = Utils::HttpGet(sprintf("/nft/nfts/%s/%s", $request->class_id, $request->nft_id), []);
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($nft);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($nft->getStatusCode(), ""));
        return $response;
    }

    /**
     * 查询 NFT 操作记录
     *
     * 根据查询条件，展示与应用相关的 NFT 链上操作记录
     *
     * @param QueryNFTHistoryReq $request
     * @return BaseResponse
     */
    public function QueryNFTHistory(QueryNFTHistoryReq $request) :BaseResponse
    {
        if ($request->class_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "class_id is required");
        }
        if ($request->nft_id == "") {
            return new BaseResponse(BaseResponse::$code_error, "nft_id is required");
        }

        try {
            $NFTHistorys = Utils::HttpGet(sprintf("/nft/nfts/%s/%s/history", $request->class_id, $request->nft_id), $request->toArray());
        }catch (\Throwable $throwable) {
            return Utils::exceptionHandle($throwable);
        }
        $data = Utils::formatBody($NFTHistorys);
        $response = new BaseResponse(BaseResponse::$code_success, "", $data["data"], new ExceptionRes(), new HttpRes($NFTHistorys->getStatusCode(), ""));
        return $response;
    }
}