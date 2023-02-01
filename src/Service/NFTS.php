<?php
/**
 *
 * User: yu
 * Date: 2023/1/9
 * Email: <Tianyu@bianjie.ai>
 */
namespace Bianjieai\AvataSdkPhp\Service;

use Bianjieai\AvataSdkPhp\Exception\Exception;
use Bianjieai\AvataSdkPhp\Models\NFTS\BatchCreateNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\BatchCreateNFTRes;
use Bianjieai\AvataSdkPhp\Models\NFTS\BatchDeleteNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\BatchDeleteNFTRes;
use Bianjieai\AvataSdkPhp\Models\NFTS\BatchEditNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\BatchEditNFTRes;
use Bianjieai\AvataSdkPhp\Models\NFTS\BatchTransferNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\BatchTransferNFTRes;
use Bianjieai\AvataSdkPhp\Models\NFTS\CreateNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\CreateNFTRes;
use Bianjieai\AvataSdkPhp\Models\NFTS\DeleteNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\DeleteNFTRes;
use Bianjieai\AvataSdkPhp\Models\NFTS\EditNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\EditNFTRes;
use Bianjieai\AvataSdkPhp\Models\NFTS\QueryNFTHistoryReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\QueryNFTHistoryRes;
use Bianjieai\AvataSdkPhp\Models\NFTS\QueryNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\QueryNFTRes;
use Bianjieai\AvataSdkPhp\Models\NFTS\QueryNFTSReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\QueryNFTSRes;
use Bianjieai\AvataSdkPhp\Models\NFTS\TransferNFTReq;
use Bianjieai\AvataSdkPhp\Models\NFTS\TransferNFTRes;
use Bianjieai\AvataSdkPhp\Utils\Utils;

class NFTS extends Base
{
    /**
     * 发行 NFT
     *
     * NFT 是链上唯一的、可识别的资产，由用户自己在区块链上铸造一个NFT
     *
     * @param CreateNFTReq $request
     * @return CreateNFTRes
     * @throws Exception
     */
    public function CreateNFT(CreateNFTReq $request): CreateNFTRes
    {
        if ($request->class_id == "") {
            throw new Exception("class_id is required");
        }
        if ($request->name == "") {
            throw new Exception( "name is required");
        }
        if ($request->operation_id == "") {
            throw new Exception( "operation_id is required");
        }

        try {
            $classes = Utils::HttpPost(sprintf("/nft/nfts/%s", $request->class_id), $request->toArray());
        }catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($classes);
        return new CreateNFTRes($data["data"]);
    }

    /**
     * 转让 NFT
     *
     * 注意：在调用此接口时，「Avata」API 服务平台「允许」应用平台方将 NFT 转让给「任一文昌链合法链账户地址」
     *
     * @param TransferNFTReq $request
     * @return TransferNFTRes
     * @throws Exception
     */
    public function TransferNFT(TransferNFTReq $request): TransferNFTRes
    {
        if ($request->class_id == "") {
            throw new Exception("class_id is required");
        }
        if ($request->owner == "") {
            throw new Exception( "owner is required");
        }
        if ($request->nft_id == "") {
            throw new Exception( "nft_id is required");
        }
        if ($request->recipient == "") {
            throw new Exception( "recipient is required");
        }
        if ($request->operation_id == "") {
            throw new Exception( "operation_id is required");
        }

        try {
            $nft = Utils::HttpPost(sprintf("/nft/nft-transfers/%s/%s/%s", $request->class_id, $request->owner, $request->nft_id), $request->toArray());
        }catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($nft);
        return new TransferNFTRes($data["data"]);
    }

    /**
     * 编辑 NFT
     *
     * 对于已经发布至链上的 NFT ，可根据需求来编辑链上 NFT 的相关信息，如名称、元数据等信息。
     * 注意：只可编辑自己链账户所拥有的 NFT 信息，对于由自己发行，但已经归属于其它链账户地址的 NFT，不可进行编辑。
     *
     * @param EditNFTReq $request
     * @return EditNFTRes
     * @throws Exception
     */
    public function EditNFT(EditNFTReq $request): EditNFTRes
    {
        if ($request->class_id == "") {
            throw new Exception(  "class_id is required");
        }
        if ($request->owner == "") {
            throw new Exception( "owner is required");
        }
        if ($request->nft_id == "") {
            throw new Exception(  "nft_id is required");
        }
        if ($request->name == "") {
            throw new Exception(  "name is required");
        }
        if ($request->operation_id == "") {
            throw new Exception(  "operation_id is required");
        }

        try {
            $nft = Utils::HttpPatch(sprintf("/nft/nfts/%s/%s/%s", $request->class_id, $request->owner, $request->nft_id), $request->toArray());
        }catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($nft);
        return new EditNFTRes($data["data"]);
    }

    /**
     * 销毁 NFT
     *
     * 用户可以销毁自己链账户地址中拥有的 NFT
     * NFT 销毁后，链上依然会保留与该 NFT 相关的链上历史记录信息，但不可再对该 NFT 进行任何的操作。
     *
     * @param DeleteNFTReq $request
     * @return DeleteNFTRes
     * @throws Exception
     */
    public function DeleteNFT(DeleteNFTReq $request): DeleteNFTRes
    {
        if ($request->class_id == "") {
            throw new Exception("class_id is required");
        }
        if ($request->owner == "") {
            throw new Exception( "owner is required");
        }
        if ($request->nft_id == "") {
            throw new Exception( "nft_id is required");
        }
        if ($request->operation_id == "") {
            throw new Exception( "operation_id is required");
        }
        try {
            $nft = Utils::HttpDelete(sprintf("/nft/nfts/%s/%s/%s", $request->class_id, $request->owner, $request->nft_id), $request->toArray());
        }catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($nft);
        return new DeleteNFTRes($data["data"]);
    }

    /**
     * 批量发行 NFT
     *
     * NFT 是链上唯一的、可识别的资产，由用户自己在区块链上批量铸造 NFT，单次请求批量发行数量上限10。
     * 使用批量发行 NFT 接口时，需保证此交易体小于 7000 字节，如果交易体数据很难估算准确，建议避免使用批量发行方法。
     * 由于批量发行方法对网络平滑出块影响比较大，后续其 GAS 费有可能被调高以不鼓励批量发行方法的使用。
     *
     * @param BatchCreateNFTReq $request
     * @return BatchCreateNFTRes
     * @throws Exception
     */
    public function BatchCreateNFT(BatchCreateNFTReq $request): BatchCreateNFTRes
    {
        if ($request->class_id == "") {
            throw new Exception( "class_id is required");
        }
        if ($request->name == "") {
            throw new Exception( "name is required");
        }
        if (count($request->recipients) < 1) {
            throw new Exception( "recipients is required");
        }
        if ($request->operation_id == "") {
            throw new Exception( "operation_id is required");
        }

        try {
            $nfts = Utils::HttpPost(sprintf("/nft/batch/nfts/%s", $request->class_id), $request->toArray());
        }catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($nfts);
        return new BatchCreateNFTRes($data["data"]);
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
     * @return BatchTransferNFTRes
     * @throws Exception
     */
    public function BatchTransferNFT(BatchTransferNFTReq $request): BatchTransferNFTRes
    {
        if ($request->owner == "") {
            throw new Exception( "owner is required");
        }
        if ($request->operation_id == "") {
            throw new Exception("operation_id is required");
        }
        if (count($request->data) < 1) {
            throw new Exception("data is required");
        }

        try {
            $nfts = Utils::HttpPost(sprintf("/nft/batch/nft-transfers/%s", $request->owner), $request->toArray());
        }catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($nfts);
        return new BatchTransferNFTRes($data["data"]);
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
     * @return BatchEditNFTRes
     * @throws Exception
     */
    public function BatchEditNFT(BatchEditNFTReq $request): BatchEditNFTRes
    {
        if ($request->owner == "") {
            throw new Exception( "owner is required");
        }
        if ($request->operation_id == "") {
            throw new Exception("operation_id is required");
        }
        if (count($request->nfts) < 1) {
            throw new Exception( "nfts is required");
        }

        try {
            $nfts = Utils::HttpPatch(sprintf("/nft/batch/nfts/%s", $request->owner), $request->toArray());
        }catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($nfts);
        return new BatchEditNFTRes($data["data"]);
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
     * @return BatchDeleteNFTRes
     * @throws Exception
     */
    public function BatchDeleteNFT(BatchDeleteNFTReq $request): BatchDeleteNFTRes
    {
        if ($request->owner == "") {
            throw new Exception("owner is required");
        }
        if ($request->operation_id == "") {
            throw new Exception("operation_id is required");
        }
        if (count($request->nfts) < 1) {
            throw new Exception("nfts is required");
        }

        try {
            $nfts = Utils::HttpDelete(sprintf("/nft/batch/nfts/%s", $request->owner), $request->toArray());
        }catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($nfts);
        return new BatchDeleteNFTRes($data["data"]);
    }

    /**
     * 查询 NFT
     *
     * 根据查询条件，展示 Avata 平台内的 NFT 列表
     *
     * @param QueryNFTSReq $request
     * @return QueryNFTSRes
     * @throws Exception
     */
    public function QueryNFTS(QueryNFTSReq $request): QueryNFTSRes
    {
        try {
            $nfts = Utils::HttpGet("/nft/nfts", $request->toArray());
        }catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($nfts);
        return new QueryNFTSRes($data["data"]);
    }

    /**
     * 查询 NFT 详情
     *
     * 根据查询条件，展示 Avata 平台内的 NFT 对应的详情信息
     *
     * @param QueryNFTReq $request
     * @return QueryNFTRes
     * @throws Exception
     */
    public function QueryNFT(QueryNFTReq $request): QueryNFTRes
    {
        if ($request->class_id == "") {
            throw new Exception("class_id is required");
        }
        if ($request->nft_id == "") {
            throw new Exception("nft_id is required");
        }

        try {
            $nft = Utils::HttpGet(sprintf("/nft/nfts/%s/%s", $request->class_id, $request->nft_id), []);
        }catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($nft);
        return new QueryNFTRes($data["data"]);
    }

    /**
     * 查询 NFT 操作记录
     *
     * 根据查询条件，展示与应用相关的 NFT 链上操作记录
     *
     * @param QueryNFTHistoryReq $request
     * @return QueryNFTHistoryRes
     * @throws Exception
     */
    public function QueryNFTHistory(QueryNFTHistoryReq $request): QueryNFTHistoryRes
    {
        if ($request->class_id == "") {
            throw new Exception("class_id is required");
        }
        if ($request->nft_id == "") {
            throw new Exception("nft_id is required");
        }

        try {
            $NFTHistorys = Utils::HttpGet(sprintf("/nft/nfts/%s/%s/history", $request->class_id, $request->nft_id), $request->toArray());
        }catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($NFTHistorys);
        return new QueryNFTHistoryRes($data["data"]);
    }
}