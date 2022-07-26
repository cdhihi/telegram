<?php declare(strict_types=1);


namespace App\Model\Logic;


use App\Bean\AuthManger;
use App\Bean\AuthResult;
use App\Bean\AuthSession;
use App\Contract\AccountTypeInterface;
use App\Exception\ApiException;
use App\Exception\AuthException;
use App\Helper\ReturnHelper;
use App\Helper\TokenParserHelper;
use App\Model\Dao\UserDao;
use App\Model\Data\AdvertiseData;
use App\Model\Data\BotData;
use App\Model\Data\RoleMenuData;
use App\Model\Data\UserData;
use App\Model\Data\UserRoleData;
use App\Model\Data\VideoData;
use Swoft\Redis\Redis;
use App\Model\Entity\User;
use ReflectionException;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Bean\Exception\ContainerException;

use Swoole\Http\Client;

use Swoft\Db\Exception\DbException;
use function array_column;

/**
 * Class ApiLogic
 * @Bean()
 */
class ApiLogic
{
    /**
     * @Inject()
     * @var VideoData
     */
    protected $VideoData;


    /**
     * @Inject()
     * @var AdvertiseData
     */
    protected $AdvertiseData;

    /**
     * @Inject()
     * @var BotData
     */
    protected $BotData;



    /**
     * @Inject()
     * @var TokenParserHelper
     */
    protected $tokenParser;

    /**
     * @Inject()
     * @var UserRoleData
     */
    protected $userRoleData;

    /**
     * @Inject()
     * @var RoleMenuData
     */
    protected $roleMenuData;


    /**
     * @param array $logInfo
     * @return AuthResult
     * @throws ReflectionException
     * @throws ContainerException
     * @throws ApiException
     */
    public function login(array $logInfo): AuthResult
    {
        $identity   = $logInfo['identity'];
        $credential = $logInfo['credential'];
        /** @var User $user */
        $user   = $this->userData->getUserByIdentify($identity);
        $result = AuthResult::new();
        if ($user && $this->verify($user, $credential) && $user->getStatus() === 1) {
            $result->setIdentity((string)$user->getUid());
        } else {
            throw new ApiException('Authentication: Invalid credential or Api disabled', 400);
        }
        return $result;
    }


    /**
     * 短视频
     * @param array $post
     * @param int $bot_id
     * @return array
     * @throws ReflectionException
     * @throws ContainerException
     * @throws ApiException
     */
    public function short_video($post, $bot_id){

        //查询出所有的短视频链接
        $vides = $this->VideoData->getVideoByType(1);
        $count = count($vides);
        $chat_id = $post['callback_query']['message']['chat']['id'];
        $iChatId = abs($chat_id);
        $sVideRedisKey= "short_video_vide_{$iChatId}";
        $chatNum = Redis::IncrBy($sVideRedisKey,1);
        if( $count <= $chatNum){
            Redis::del($sVideRedisKey);
            $chatNum = 0;
        }
        $video = $vides[$chatNum]->toArray();
        //调用接口

        $aInlineKeyboard = [
            [['text' =>  "长视频", 'callback_data' => 'long_video'],['text' =>  "短视频", 'callback_data' => 'short_video']]
        ];

        //获取redis 设置的广告
        $sGroupAdvertisesKey= "short_group_advertises_{$iChatId}"; //群广告的key

        //设置群广告
//        Redis::hSet($sGroupAdvertisesKey,"2",json_encode(['text' =>  "广告2", 'url' => "https://www.baidu.com12/"]));
//        Redis::hSet($sGroupAdvertisesKey,"1",json_encode(['text' =>  "广告", 'url' => "https://www.baidu.com/"]));
//        Redis::hSet($sGroupAdvertisesKey,"3",json_encode(['text' =>  "广告3", 'url' => "https://www.baidu.com/"]));
        $aGroupAdvertises = Redis::hGetAll($sGroupAdvertisesKey);
        if (!empty($aGroupAdvertises)){
            foreach ($aGroupAdvertises as $k => $v){
                $aInlineKeyboard[] = [json_decode($v, true)];
            }
        }

        //随机自己广告
        //获取所有广告列表
        $aAdvertises = $this->AdvertiseData->getAdvertises();
        $iSjKey = rand(0,count($aAdvertises)-1);
        $aInlineKeyboard[] = [[
            'text' => $aAdvertises[$iSjKey]['name'],
            'url' => $aAdvertises[$iSjKey]['link'],
        ]];
        $keyboard = [
            'inline_keyboard' =>  $aInlineKeyboard
        ];

        var_dump($keyboard);
        $markup = json_encode($keyboard);


        $content = [
            'chat_id' => $chat_id,
            'reply_markup' => $markup,
            'video'=> $video['link'],
            'caption' => $video['describe'],
            'disable_notification' => true
        ];

        //获取机器人的key
        $aBotInfo = $this->BotData->getBot($bot_id);
        $sUrl = "https://api.telegram.org/bot{$aBotInfo['propertyKey']}/sendVideo";

        //发送消息
        $reData = $this->curlPost($sUrl, $content);
    }



    /**
     * 长视频
     * @param array $post
     * @param int $bot_id
     * @return array
     * @throws ReflectionException
     * @throws ContainerException
     * @throws ApiException
     */
    public function long_video($post, $bot_id){

        //查询出所有的短视频链接
        $vides = $this->VideoData->getVideoByType(1);
        $count = count($vides);
        $chat_id = $post['callback_query']['message']['chat']['id'];
        $iChatId = abs($chat_id);
        $sVideRedisKey= "long_video_vide_{$iChatId}";
        $chatNum = Redis::IncrBy($sVideRedisKey,1);
        if( $count <= $chatNum){
            Redis::del($sVideRedisKey);
            $chatNum = 0;
        }
        $video = $vides[$chatNum]->toArray();
        //调用接口

        $aInlineKeyboard = [
            [['text' =>  "长视频", 'callback_data' => 'long_video'],['text' =>  "短视频", 'callback_data' => 'short_video']]
        ];

        //获取redis 设置的广告
        $sGroupAdvertisesKey= "long_group_advertises_{$bot_id}"; //群广告的key

        //设置群广告
//        Redis::hSet($sGroupAdvertisesKey,"$iChatId",json_encode(2=>['text' =>  "广告2", 'url' => "https://www.baidu.com12/"],1=>['text' =>  "广告", 'url' => "https://www.baidu.com/"]));
//        Redis::hSet($sGroupAdvertisesKey,"$iChatId",json_encode([1=>['text' =>  "广告3", 'url' => "https://www.baidu.com/"],2=>['text' =>  "广告", 'url' => "https://www.baidu.com/"]]));
        $aGroupAdvertises = Redis::hGet($sGroupAdvertisesKey,"$iChatId");
        if (!empty($aGroupAdvertises)){
            foreach ($aGroupAdvertises as $k => $v){
                $aInlineKeyboard[] = [json_decode($v, true)];
            }
        }

        //随机自己广告
        //获取所有广告列表
        $aAdvertises = $this->AdvertiseData->getAdvertises();
        $iSjKey = rand(0,count($aAdvertises)-1);
        $aInlineKeyboard[] = [[
            'text' => $aAdvertises[$iSjKey]['name'],
            'url' => $aAdvertises[$iSjKey]['link'],
        ]];
        $keyboard = [
            'inline_keyboard' =>  $aInlineKeyboard
        ];

        $markup = json_encode($keyboard);
        $content = [
            'chat_id' => $chat_id,
            'reply_markup' => $markup,
            'video'=> $video['link'],
            'caption' => $video['describe'],
            'disable_notification' => true
        ];

        //获取机器人的key
        $aBotInfo = $this->BotData->getBot($bot_id);
        $sUrl = "https://api.telegram.org/bot{$aBotInfo['propertyKey']}/sendVideo";

        //发送消息
        $reData = $this->curlPost($sUrl, $content);
    }



    function curlPost($url, $post_data = array(), $timeout = 5, $header = "", $data_type = "") {
        $header = empty($header) ? '' : $header;
        //支持json数据数据提交
        if($data_type == 'json'){
            $post_string = json_encode($post_data);
        }elseif($data_type == 'array') {
            $post_string = $post_data;
        }elseif(is_array($post_data)){
            $post_string = http_build_query($post_data, '', '&');
        }

        $ch = curl_init();    // 启动一个CURL会话
        curl_setopt($ch, CURLOPT_URL, $url);     // 要访问的地址
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  // 对认证证书来源的检查   // https请求 不验证证书和hosts
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  // 从证书中检查SSL加密算法是否存在
//        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        //curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($ch, CURLOPT_POST, true); // 发送一个常规的Post请求
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);     // Post提交的数据包
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);     // 设置超时限制防止死循环
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        //curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     // 获取的信息以文件流的形式返回
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $header); //模拟的header头
        curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.75 Safari/537.36');

        $result = curl_exec($ch);

        // 打印请求的header信息
        //$a = curl_getinfo($ch);
        //var_dump($a);

        curl_close($ch);
        return $result;
    }



    /**
     * 开车机器人自动恢复
     * @param array $post
     * @param int $bot_id
     * @return array
     * @throws ApiException
     */
    public function kc($post, $bot_id){

        $chat_id = $post['message']['chat']['id'];
        $aKcfjKey = "kc_ds_room_id_{$bot_id}";
        //启动自动开车服务
        Redis::sAdd($aKcfjKey,"$chat_id");




//        //查询出所有的短视频链接
//        $vides = $this->VideoData->getVideoByType(1);
//        $count = count($vides);
//        $iChatId = abs($chat_id);
//        $sVideRedisKey= "short_video_vide_{$iChatId}";
//        $chatNum = Redis::IncrBy($sVideRedisKey,1);
//        if( $count <= $chatNum){
//            Redis::del($sVideRedisKey);
//            $chatNum = 0;
//        }
//        $video = $vides[$chatNum]->toArray();
//        //调用接口
//
//        $aInlineKeyboard = [
//            [['text' =>  "长视频", 'callback_data' => 'long_video'],['text' =>  "短视频", 'callback_data' => 'short_video']]
//        ];
//
//        //获取redis 设置的广告
//        $sGroupAdvertisesKey= "short_group_advertises_{$bot_id}"; //群广告的key
//        //设置群广告
//        $aGroupAdvertises = Redis::hGet($sGroupAdvertisesKey,"$chat_id");
//
//        if (!empty($aGroupAdvertises)){
//            $aGroupAdvertises = json_decode($aGroupAdvertises,true);
//        }
//
//        if (!empty($aGroupAdvertises)){
//            foreach ($aGroupAdvertises as $k => $v){
//
//                $aInlineKeyboard[] = [$v];
//            }
//        }
//
//        //随机自己广告
//        //获取所有广告列表
//        $aAdvertises = $this->AdvertiseData->getAdvertises();
//        $iSjKey = rand(0,count($aAdvertises)-1);
//        $aInlineKeyboard[] = [[
//            'text' => $aAdvertises[$iSjKey]['name'],
//            'url' => $aAdvertises[$iSjKey]['link'],
//        ]];
//        $keyboard = [
//            'inline_keyboard' =>  $aInlineKeyboard
//        ];
//
//        $markup = json_encode($keyboard);
//
//        $content = [
//            'chat_id' => $chat_id,
//            'reply_markup' => $markup,
//            'video'=> $video['link'],
//            'caption' => $video['describe'],
//            'disable_notification' => true
//        ];
//
//        //获取机器人的key
//        $aBotInfo = $this->BotData->getBot($bot_id);
//        $sUrl = "https://api.telegram.org/bot{$aBotInfo['propertyKey']}/sendVideo";
//
//        //发送消息
//        $reData = $this->curlPost($sUrl, $content);
    }


    /**
     * 开车机器人自动恢复
     * @param array $post
     * @param int $bot_id
     * @return array
     * @throws ApiException
     */
    public function zt($post, $bot_id){



        $chat_id = $post['message']['chat']['id'];
        $aKcfjKey = "kc_ds_room_id_{$bot_id}";
        //删除开车服务

        Redis::sRem($aKcfjKey,"$chat_id");
        Redis::sRem($aKcfjKey,$chat_id);


    }





    /**
     * 群组添加广告
     * @param array $post
     * @param int $bot_id
     * @return array
     * @throws ApiException
     */
    public function adGg($post, $bot_id){

        $chat_id = $post['message']['chat']['id'];
        $iChatId = abs($chat_id);
        //获取redis 设置的广告
        $sGroupAdvertisesKey= "short_group_advertises_{$bot_id}"; //群广告的key

        $postMessage = explode(" ",$post['message']['text']);
        //读取广告
        $aGroupAdvertises = Redis::hGet($sGroupAdvertisesKey,"$chat_id");

        if (!empty($aGroupAdvertises)){
            $aGroupAdvertises = json_decode($aGroupAdvertises,true);
        }
        $aGroupAdvertises[$postMessage[0]] = [
            'text' => $postMessage[1],
            'url' => $postMessage[2]
        ];

        var_dump($sGroupAdvertisesKey,$iChatId);
        var_dump($aGroupAdvertises);
        Redis::hSet($sGroupAdvertisesKey,"$chat_id",json_encode($aGroupAdvertises));

        //覆盖广告
        $aPostData = [
            'chat_id' => $chat_id,
            'text' => "{$postMessage[0]}-设置成功"
        ];
        $aBotInfo = $this->BotData->getBot($bot_id);
        $sUrl = "https://api.telegram.org/bot{$aBotInfo['propertyKey']}/sendMessage";

        //发送消息
        $reData = $this->curlPost($sUrl, $aPostData);
        var_dump($reData);

    }




}
