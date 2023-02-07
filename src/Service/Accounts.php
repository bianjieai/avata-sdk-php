<?php
/**
 *
 * User: yu
 * Date: 2023/1/9
 * Email: <Tianyu@bianjie.ai>
 */

namespace Bianjieai\AvataSdkPhp\Service;


use Bianjieai\AvataSdkPhp\Models\Accounts\BatchCreateAccountsReq;
use Bianjieai\AvataSdkPhp\Models\Accounts\BatchCreateAccountsRes;
use Bianjieai\AvataSdkPhp\Models\Accounts\CreateAccountsReq;
use Bianjieai\AvataSdkPhp\Models\Accounts\CreateAccountsRes;
use Bianjieai\AvataSdkPhp\Models\Accounts\QueryAccountsHistoryReq;
use Bianjieai\AvataSdkPhp\Models\Accounts\QueryAccountsHistoryRes;
use Bianjieai\AvataSdkPhp\Models\Accounts\QueryAccountsReq;
use Bianjieai\AvataSdkPhp\Exception\Exception;
use Bianjieai\AvataSdkPhp\Models\Accounts\QueryAccountsRes;
use Bianjieai\AvataSdkPhp\Utils\Utils;


final class Accounts extends Base
{
    /**
     * 创建链账户
     *
     * 链账户是应用方或其用户在区块链上的账户地址，用于存储和管理在区块链上所拥有的资产。
     * 目前通过 Avata 平台创建的文昌链原生链账户地址生成即上链，会产生一笔上链交易所需费用（0.05元/个）。
     * 建议应用方按照实际会与底层链交互的活跃用户数进行链账户创建。
     *
     * @param CreateAccountsReq $request
     * @return Exception|CreateAccountsRes
     * @throws Exception
     */
    public function CreateAccount(CreateAccountsReq $request): CreateAccountsRes
    {
        if ($request->name == "") {
            throw new Exception("name is required");
        }
        if ($request->operation_id == "") {
            throw new Exception("operation_id is required");
        }

        try {
            $account = Utils::HttpPost("/account", [
                $request->getNameKey() => $request->name,
                $request->getOperationIDKey() => $request->operation_id,
            ]);
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }
        $data = Utils::formatBody($account);
        return new CreateAccountsRes($data["data"]);
    }

    /**
     * 批量创建链账户
     *
     * 链账户是应用方或其用户在区块链上的账户地址，用于存储和管理在区块链上所拥有的资产。
     * 目前通过 Avata 平台创建的文昌链原生链账户地址生成即上链，会产生一笔上链交易所需费用（0.05元/个）。
     * 建议应用方按照实际会与底层链交互的活跃用户数进行链账户创建。
     *
     * @param BatchCreateAccountsReq $request
     * @return BatchCreateAccountsRes
     * @throws Exception
     */
    public function BatchCreateAccounts(BatchCreateAccountsReq $request): BatchCreateAccountsRes
    {
        if ($request->count == 0) {
            $request->count = 1;
        }
        if ($request->operation_id == "") {
            throw new Exception("operation_id is required");
        }

        try {
            $account = Utils::HttpPost("/accounts", [
                $request->getCountKey() => $request->count,
                $request->getOperationIDKey() => $request->operation_id,
            ]);
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }

        $data = Utils::formatBody($account);
        return new BatchCreateAccountsRes($data["data"]);
    }

    /**
     *  查询链账户
     *
     * 根据文档中给出的具体的查询条件查询和获取与应用方某一项目 ID 相互绑定的链账户地址
     *
     * @param QueryAccountsReq $request
     * @return QueryAccountsRes
     * @throws Exception
     */
    public function QueryAccounts(QueryAccountsReq $request): QueryAccountsRes
    {
        try {
            $accounts = Utils::HttpGet("/accounts", $request->toArray());
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }

        $data = Utils::formatBody($accounts);
        return new QueryAccountsRes($data["data"]);
    }

    /**
     * 查询链账户操作记录
     *
     * 查询具体某一个链账户在区块链上的相关操作记录及详情信息
     *
     * @param QueryAccountsHistoryReq $request
     * @return QueryAccountsHistoryRes
     * @throws Exception
     */
    public function QueryAccountsHistory(QueryAccountsHistoryReq $request): QueryAccountsHistoryRes
    {
        try {
            $accountsHistory = Utils::HttpGet("/accounts/history", $request->toArray());
        } catch (\Throwable $throwable) {
            throw Utils::HandleException($throwable);
        }

        $data = Utils::formatBody($accountsHistory);
        return new QueryAccountsHistoryRes($data["data"]);
    }
}