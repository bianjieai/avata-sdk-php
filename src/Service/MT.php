<?php

namespace Bianjieai\AvataSdkPhp\Service;


use Bianjieai\AvataSdkPhp\Exception\Exception;
use Bianjieai\AvataSdkPhp\Models\MTs\BurnMTReq;
use Bianjieai\AvataSdkPhp\Models\MTs\BurnMTRes;
use Bianjieai\AvataSdkPhp\Models\MTs\CreateMTClassRes;
use Bianjieai\AvataSdkPhp\Models\MTs\EditMTReq;
use Bianjieai\AvataSdkPhp\Models\MTs\EditMTRes;
use Bianjieai\AvataSdkPhp\Models\MTs\IssueMTRes;
use Bianjieai\AvataSdkPhp\Models\MTs\MintMTReq;
use Bianjieai\AvataSdkPhp\Models\MTs\MintMTRes;
use Bianjieai\AvataSdkPhp\Models\MTs\QueryMTBalanceReq;
use Bianjieai\AvataSdkPhp\Models\MTs\QueryMTBalanceRes;
use Bianjieai\AvataSdkPhp\Models\MTs\QueryMTClassesReq;
use Bianjieai\AvataSdkPhp\Models\MTs\QueryMTClassesRes;
use Bianjieai\AvataSdkPhp\Models\MTs\QueryMTClassReq;
use Bianjieai\AvataSdkPhp\Models\MTs\QueryMTClassRes;
use Bianjieai\AvataSdkPhp\Models\MTs\QueryMTHistoryReq;
use Bianjieai\AvataSdkPhp\Models\MTs\QueryMTHistoryRes;
use Bianjieai\AvataSdkPhp\Models\MTs\QueryMTReq;
use Bianjieai\AvataSdkPhp\Models\MTs\QueryMTRes;
use Bianjieai\AvataSdkPhp\Models\MTs\QueryMTsReq;
use Bianjieai\AvataSdkPhp\Models\MTs\QueryMTsRes;
use Bianjieai\AvataSdkPhp\Models\MTs\TransferMTClassRes;
use Bianjieai\AvataSdkPhp\Models\MTs\TransferMTReq;
use Bianjieai\AvataSdkPhp\Models\MTs\TransferMTRes;
use Bianjieai\AvataSdkPhp\Utils\Utils;
use Bianjieai\AvataSdkPhp\Models\MTs\CreateMTClassReq;
use Bianjieai\AvataSdkPhp\Models\MTs\IssueMTReq;
use Bianjieai\AvataSdkPhp\Models\MTs\TransferMTClassReq;

final class MT extends Base
{
    /**
     * 创建 MT 类别
     *
     * MT 类别是 IRITA 底层链对同一资产类型的识别和集合，方便资产发行方对链上资产进行管理和查询。
     * 所以链上资产在发行前，都需要创建 MT 类别，用以声明其抽象属性。
     *
     * @param CreateMTClassReq $request
     * @return CreateMTClassRes
     * @throws Exception
     */
    public function CreateMTClass(CreateMTClassReq $request): CreateMTClassRes
    {
        if ($request->name == "") {
            throw new Exception("name is required");
        }
        if ($request->owner == "") {
            throw new Exception("owner is required");
        }
        if ($request->operation_id == "") {
            throw new Exception("operation_id is required");
        }

        try {
            $result = Utils::HttpPost("/mt/classes", [
                $request->getNameKey() => $request->name,
                $request->getOwnerKey() => $request->owner,
                $request->getDataKey() => $request->data,
                $request->getTagKey() => $request->tag,
                $request->getOperationIDKey() => $request->operation_id,
            ]);
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }

        $data = Utils::formatBody($result);
        return new CreateMTClassRes($data["data"]);
    }

    /**
     * 转让 MT 类别
     *
     * MT 类别是 IRITA 底层链对同一资产类型的识别和集合，方便资产发行方对链上资产进行管理和查询。
     * 所以链上资产在发行前，都需要创建 MT 类别，用以声明其抽象属性。
     *
     * @param string $classID
     * @param string $owner
     * @param TransferMTClassReq $request
     * @return TransferMTClassRes
     * @throws Exception
     */
    public function TransferMTClass(string $classID, string $owner, TransferMTClassReq $request): TransferMTClassRes
    {
        if ($request->recipient == "") {
            throw new Exception("recipient is required");
        }
        if ($request->operation_id == "") {
            throw new Exception("operation_id is required");
        }

        try {
            $result = Utils::HttpPost(sprintf("/mt/class-transfers/%s/%s", $classID, $owner), [
                $request->getRecipientKey() => $request->recipient,
                $request->getTagKey() => $request->tag,
                $request->getOperationIDKey() => $request->operation_id,
            ]);
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }

        $data = Utils::formatBody($result);
        return new TransferMTClassRes($data["data"]);
    }

    /**
     * 查询 MT 类别
     *
     * 根据查询条件，展示 Avata 平台内的 MT 类别列表
     *
     * @param QueryMTClassesReq $request
     * @return QueryMTClassesRes
     * @throws Exception
     */
    public function QueryMTClasses(QueryMTClassesReq $request): QueryMTClassesRes
    {
        try {
            $result = Utils::HttpGet("/mt/classes", $request->toArray());
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($result);
        return new QueryMTClassesRes($data["data"]);
    }

    /**
     * 查询 MT 类别详情
     *
     * 根据查询条件，展示 Avata 平台内的 MT 类别的详情信息
     *
     * @param QueryMTClassReq $request
     * @return QueryMTClassRes
     * @throws Exception
     */
    public function QueryMTClass(QueryMTClassReq $request): QueryMTClassRes
    {
        if ($request->id == "") {
           throw new Exception("id is required");
        }
        try {
            $classes = Utils::HttpGet(sprintf("/mt/classes/%s", $request->id), []);
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($classes);
        return new QueryMTClassRes($data["data"]);
    }


    /**
     * 发行 MT
     *
     * MT 类别权属者（MT Class Owner）通过调用此接口来发行 MT。单个 MT 的发行数量上限为 2^64-1。
     *
     * @param string $classID
     * @param IssueMTReq $request
     * @return IssueMTRes
     * @throws Exception
     */
    public function IssueMT(string $classID, IssueMTReq $request): IssueMTRes
    {
        if ($request->operation_id == "") {
            throw new Exception("operation_id is required");
        }

        try {
            $result = Utils::HttpPost(sprintf("/mt/mt-issues/%s", $classID), [
                $request->getRecipientKey() => $request->recipient,
                $request->getAmountKey() => $request->amount,
                $request->getDataKey() => $request->data,
                $request->getTagKey() => $request->tag,
                $request->getOperationIDKey() => $request->operation_id,
            ]);
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }

        $data = Utils::formatBody($result);
        return new IssueMTRes($data["data"]);
    }

    /**
     * 增发 MT
     *
     * MT 类别的 owner 通过调用此接口增发某一确定 ID 的 MT。
     * 当不填写接收者时，默认该类别的拥有者为接收者；
     * 当不填写增发数量时，默认增发数量为 1。
     *
     * @param string $classID
     * @param string $mtID
     * @param MintMTReq $request
     * @return MintMTRes
     * @throws Exception
     */
    public function MintMT(string $classID, string $mtID, MintMTReq $request): MintMTRes
    {
        if ($request->operation_id == "") {
            throw new Exception("operation_id is required");
        }

        try {
            $result = Utils::HttpPost(sprintf("/mt/mt-mints/%s/%s", $classID, $mtID), [
                $request->getRecipientKey() => $request->recipient,
                $request->getAmountKey() => $request->amount,
                $request->getTagKey() => $request->tag,
                $request->getOperationIDKey() => $request->operation_id,
            ]);
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }

        $data = Utils::formatBody($result);
        return new MintMTRes($data["data"]);
    }

    /**
     * 转让 MT
     *
     * MT 的拥有者可以向指定的链账户地址转移指定数量的 MT，目标转移地址可以是文昌链的任一合法地址
     *
     * @param string $classID
     * @param string $owner
     * @param string $mtID
     * @param TransferMTReq $request
     * @return TransferMTRes
     * @throws Exception
     */
    public function TransferMT(string $classID, string $owner, string $mtID, TransferMTReq $request): TransferMTRes
    {
        if ($request->recipient == "") {
            throw new Exception("recipient is required");
        }
        if ($request->operation_id == "") {
            throw new Exception("operation_id is required");
        }

        try {
            $result = Utils::HttpPost(sprintf("/mt/mt-transfers/%s/%s/%s", $classID, $owner, $mtID), [
                $request->getRecipientKey() => $request->recipient,
                $request->getAmountKey() => $request->amount,
                $request->getTagKey() => $request->tag,
                $request->getOperationIDKey() => $request->operation_id,
            ]);
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }

        $data = Utils::formatBody($result);
        return new TransferMTRes($data["data"]);
    }

    /**
     * 编辑 MT
     *
     * MT 类别权属者（MT Class Owner）通过调用此接口可以修改链上 MT 的元数据。
     *
     * @param string $classID
     * @param string $owner
     * @param string $mtID
     * @param EditMTReq $request
     * @return EditMTRes
     * @throws Exception
     */
    public function EditMT(string $classID, string $owner, string $mtID, EditMTReq $request): EditMTRes
    {
        if ($request->data == "") {
            throw new Exception("data is required");
        }
        if ($request->operation_id == "") {
            throw new Exception("operation_id is required");
        }

        try {
            $result = Utils::HttpPatch(sprintf("/mt/mts/%s/%s/%s", $classID, $owner, $mtID), [
                $request->getDataKey() => $request->data,
                $request->getTagKey() => $request->tag,
                $request->getOperationIDKey() => $request->operation_id,
            ]);
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }

        $data = Utils::formatBody($result);
        return new EditMTRes($data["data"]);
    }

    /**
     * 销毁 MT
     *
     * MT 的拥有者可以销毁自己链账户地址中的某一个 MT。其中，销毁的最大数量为实际拥有该 MT 的数量。
     * 注：当销毁的数量为 0 时，默认为 1。
     *
     * @param string $classID
     * @param string $owner
     * @param string $mtID
     * @param BurnMTReq $request
     * @return BurnMTRes
     * @throws Exception
     */
    public function BurnMT(string $classID, string $owner, string $mtID, BurnMTReq $request): BurnMTRes
    {
        if ($request->operation_id == "") {
            throw new Exception("operation_id is required");
        }

        try {
            $result = Utils::HttpDelete(sprintf("/mt/mts/%s/%s/%s", $classID, $owner, $mtID), [
                $request->getAmountKey() => $request->amount,
                $request->getTagKey() => $request->tag,
                $request->getOperationIDKey() => $request->operation_id,
            ]);
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }

        $data = Utils::formatBody($result);
        return new BurnMTRes($data["data"]);
    }

    /**
     * 查询 MT
     *
     * 根据查询条件，展示 Avata 平台内的 MT 列表
     *
     * @param QueryMTsReq $request
     * @return QueryMTsRes
     * @throws Exception
     */
    public function QueryMTs(QueryMTsReq $request): QueryMTsRes
    {
        try {
            $result = Utils::HttpGet("/mt/mts", $request->toArray());
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($result);
        return new QueryMTsRes($data["data"]);
    }

    /**
     * 查询 MT 详情
     *
     * 根据查询条件，展示 Avata 平台内的 MT 类别的详情信息
     *
     * @param QueryMTReq $request
     * @return QueryMTRes
     * @throws Exception
     */
    public function QueryMT(QueryMTReq $request): QueryMTRes
    {
        if ($request->class_id == "") {
            throw new Exception("class_id is required");
        }
        if ($request->mt_id == "") {
            throw new Exception("mt_id is required");
        }
        try {
            $result = Utils::HttpGet(sprintf("/mt/mts/%s/%s", $request->class_id, $request->mt_id), []);
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($result);
        return new QueryMTRes($data["data"]);
    }

    /**
     * 查询 MT 操作记录
     *
     * 根据查询条件，展示与应用相关的 MT 链上操作记录
     *
     * @param string $classID
     * @param string $mtID
     * @param QueryMTHistoryReq $request
     * @return QueryMTHistoryRes
     * @throws Exception
     */
    public function QueryMTHistory(string $classID, string $mtID, QueryMTHistoryReq $request): QueryMTHistoryRes
    {
        if ($classID == "") {
            throw new Exception("class_id is required");
        }
        if ($mtID == "") {
            throw new Exception("mt_id is required");
        }
        try {
            $result = Utils::HttpGet(sprintf("/mt/mts/%s/%s/history", $classID, $mtID), $request->toArray());
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }

        $data = Utils::formatBody($result);
        return new QueryMTHistoryRes($data["data"]);
    }

    /**
     * 查询 MT 余额
     *
     * 根据查询条件，展示链账户拥有的 MT 余额(AVATA 平台内)
     *
     * @param string $classID
     * @param string $account
     * @param QueryMTBalanceReq $request
     * @return QueryMTBalanceRes
     * @throws Exception
     */
    public function QueryMTBalance(string $classID, string $account, QueryMTBalanceReq $request): QueryMTBalanceRes
    {
        if ($classID == "") {
            throw new Exception("class_id is required");
        }
        if ($account == "") {
            throw new Exception( "account is required");
        }
        try {
            $result = Utils::HttpGet(sprintf("/mt/mts/%s/%s/balances", $classID, $account), $request->toArray());
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }

        $data = Utils::formatBody($result);
        return new QueryMTBalanceRes($data["data"]);
    }
}