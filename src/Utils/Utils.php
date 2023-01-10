<?php
/**
 *
 * User: yu
 * Date: 2023/1/10
 * Email: <Tianyu@bianjie.ai>
 */
namespace Bianjieai\AvataSdkPhp\Utils;

use Bianjieai\AvataSdkPhp\Response\ExceptionResponse;
use Bianjieai\AvataSdkPhp\Response\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;


final class Utils
{
    /**
     * @var Client http请求客户端
     */
    protected static $client;

    /**
     * @var string 项目KEY
     */
    protected static $apiKey;

    /**
     * @var string 项目密钥
     */
    protected static $apiSecret;

    /**
     * domain Avata请求地址
     * @var string
     */
    protected static $domain;

    public function __construct(array $cfg)
    {
        $client = new Client([
            "timeout"         => $cfg["http_timeout"],
            "allow_redirects" => false,

        ]);
        self::$apiKey = $cfg["api_key"];
        self::$apiSecret = $cfg["api_secret"];
        self::$domain = $cfg["domain"];
        self::$client = $client;
    }

    /**
     * POST 请求
     *
     * @param string $path
     * @param array $body
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function httpPost(string $path, array $body)
    {
        $timestamp = self::getMillisecond();
        $signature = self::signature($path, $timestamp, [], $body);
        $res = self::$client->post(self::$domain. $path, [
            "headers" => [
                "X-Api-Key"     => self::$apiKey,
                "X-Timestamp"   => $timestamp,
                "X-Signature"   => $signature,
                "Content-Type"  => "application/json",
            ],
            "json" => $body,
        ]);
        return $res;
    }

    /**
     * 解析Body参数,返回数据
     *
     * @param ResponseInterface $response
     * @return array
     */
    public static function formatBody(ResponseInterface $response) :array
    {
        $body = $response->getBody();
        $stringBody = (string) $body->getContents();
        $arrayBody = json_decode($stringBody, true);
        return $arrayBody;
    }
    /**
     * 生成签名参数
     *
     * @param string $path
     * @param $timestamp
     * @param array $query
     * @param $body
     * @return string
     */
    private static function signature(string $path, $timestamp, array $query, $body) :string
    {
        $params = [
            "path_url" => $path
        ];
        if (!empty($query)) {
            foreach ($query as $k => $v) {
                $params["query_$k"] = $v;
            }
        }
        if (!empty($body)) {
            foreach ($body as $k => $v) {
                $params["body_$k"] = $v;
            }
        }
        ksort($params);
        $hexHash = hash("sha256", "$timestamp" . self::$apiSecret);
        if (count($params) > 0) {
            $s = json_encode($params, JSON_UNESCAPED_UNICODE);
            $hexHash = hash("sha256", stripcslashes($s . "$timestamp" . self::$apiSecret));
        }

        return $hexHash;
    }

    /**
     * 获取时间戳
     *
     * @return float
     */
    private static function getMillisecond() :float
    {
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($t1) + floatval($t2)));
    }

    /**
     * 异常处理
     *
     * @param ClientException $e
     * @return Response
     */
    public static function exceptionHandle(ClientException $e) :Response
    {
        $code = $e->getResponse()->getStatusCode();
        $message = $e->getResponse()->getReasonPhrase();
        $response = new Response($code, $message, [], new ExceptionResponse());
        if ($e->hasResponse()) {
            $body = $e->getResponse()->getBody();
            $stringBody = (string) $body->getContents();
            $res = json_decode($stringBody, true);
            $response->setError(new ExceptionResponse($res["error"]));
        }
        return $response;
    }
}