<?php declare(strict_types=1);


namespace App\Model\Data;

use App\Exception\ApiException;
use App\Helper\ReturnHelper;
use App\Model\Dao\BotDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * 视频数据
 * Class BotData
 * @package App\Model\Data
 * @Bean()
 */
class BotData
{
    /**
     * @Inject()
     * @var BotDao
     */
    private $BotDao;

    //获取广告列表
    public function getBots()
    {
        $Bots = $this->BotDao->getBots();
        return empty($Bots) ? [] : $Bots->toArray();
    }

    public function getBot(int $id)
    {
        $Bots = $this->BotDao->getBot($id);
        return empty($Bots) ? [] : $Bots->toArray();
    }

    public function getBotByName(string $name)
    {
        return $this->BotDao->getBotByName($name);

    }

    public function issetBotById(string $uid): bool
    {
        return (bool)$this->BotDao->getBot((int)$uid);
    }

    public function createBot(array $BotInfo)
    {
        $isBotInfo = $this->getBotByName($BotInfo['name']);
        if ($isBotInfo) {
            throw new ApiException('Bot already exist', 400);
        }
        $iBotId = $this->BotDao->createBot($BotInfo);
        //如果机器人创建成功去修改地址
        if ($iBotId){
            //获取回调地址
            $callbackApi = config('telegram_callback_api', '127.0.0.1');
            $callbackApi = $callbackApi."/auth-service/api/{$iBotId}";

            $telegramApi = "https://api.telegram.org/bot{$BotInfo['key']}/setWebhook";
            ReturnHelper::curlPost($telegramApi,['url'=>"$callbackApi"]);

        }
        return $this->BotDao->createBot($BotInfo);
    }



    public function updateBot(int $id, array $BotInfo)
    {
        //如果机器人创建成功去修改地址
        if ($id && !empty($BotInfo['property_key'])){
            //获取回调地址
            $callbackApi = config('telegram_callback_api', '127.0.0.1');
            $callbackApi = $callbackApi."/auth-service/api/{$id}";
            $telegramApi = "https://api.telegram.org/bot{$BotInfo['property_key']}/setWebhook";
            $requst = ReturnHelper::curlPost($telegramApi,['url'=>"$callbackApi"]);
        }

        return $this->BotDao->updateBot($id, $BotInfo);
    }
}
