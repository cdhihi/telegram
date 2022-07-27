<?php declare(strict_types=1);

namespace App\Task\Crontab;

use App\Helper\ReturnHelper;
use App\Model\Data\VideoData;
use App\Model\Logic\ApiLogic;
use App\Model\Entity\Bot;
use App\Model\Entity\Video;
use App\Model\Entity\Advertise;
use Swoft\Crontab\Annotaion\Mapping\Cron;
use Swoft\Crontab\Annotaion\Mapping\Scheduled;
use Swoft\Redis\Redis;

/**
 * Class DemoCronTask
 * @package App\Task\CronTask
 *
 * @Scheduled(name="CronTask")  //声明定时任务
 */
class CronTask
{

    /**
     * @var BotData
     */
    protected $BotData;

    /**
     * @var ApiLogic
     */
    protected $ApiLogic;

    /**
     * @var VideoData
     */
    protected $VideoData;



    /**
     * @Cron("5 * * * * *")
     */
    public function kcTask()
    {
        //开车定时器

        //循环机器人，查询哪些房间需要定时发送
        $aBots = Bot::all();
        $aBots = $aBots->toArray();

        //循环机器人
        foreach ($aBots as $k => $v){
            //查询需要给哪些群发送消息
            //查询有哪些群组需要定时发送
            //sadd 从集合里面取出群id
            $aKcfjKey = "kc_ds_room_id_{$v['id']}";
            $aKcfj = Redis::sMembers("$aKcfjKey");

            //循环房间
            foreach ($aKcfj as $kk => $vv){
                //查询出所有的短视频链接
                $vides = Video::all();
                $count = count($vides);
                $chat_id = $vv;
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
                $sGroupAdvertisesKey= "short_group_advertises_{$v['id']}"; //群广告的key

                //设置群广告
                $aGroupAdvertises = Redis::hGet($sGroupAdvertisesKey,"$chat_id");

                if (!empty($aGroupAdvertises)){
                    $aGroupAdvertises = json_decode($aGroupAdvertises,true);
                }

                if (!empty($aGroupAdvertises)){
                    foreach ($aGroupAdvertises as $kkk => $vvv){

                        $aInlineKeyboard[] = [$vvv];
                    }
                }

                //随机自己广告
                //获取所有广告列表
                $aAdvertises = Advertise::all();
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
                $aBotInfo = Bot::Where('id', '=', $v['id'])->first();
                $sUrl = "https://api.telegram.org/bot{$aBotInfo['key']}/sendVideo";

                //发送消息
               ReturnHelper::curlPost($sUrl,$content);
            }
        }

    }







}
