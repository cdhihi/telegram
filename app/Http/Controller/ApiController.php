<?php


namespace App\Http\Controller;

use App\Bean\AuthSession;
use App\Exception\AuthException;
use App\Helper\ReturnHelper;
use App\Helper\TokenHelper;
use App\Http\Middleware\AuthMiddleware;
use App\Model\Logic\ApiLogic;
use App\Model\Logic\AuthManagerLogic;
use ReflectionException;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Bean\Exception\ContainerException;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\Middleware;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Validator\Annotation\Mapping\Validate;
use function Bean;

/**
 * Class ApiController
 * @Controller(prefix="/api")
 */
class ApiController
{

    /**
     * @Inject()
     * @var ApiLogic
     */
    protected $ApiLogic;



    /**
     * 回调参数
     * @RequestMapping(route="{bot_id}", method={RequestMethod::POST}, params={"2", "账号登录"})
     * @Validate(validator="UserValidator", fields={"loginName", "password"})
     * )
     * @param Request $request
     * @param int $bot_id
     * @return array
     * @throws ReflectionException
     * @throws ContainerException
     */
    public function api(Request $request, int $bot_id): array
    {

        $post = $request->post();

        //如果是回调参数
        if (!empty($post['callback_query'])){
            $fun = $post['callback_query']['data'];
            $this->ApiLogic->$fun($post,$bot_id);
        }

        //如果是消息
        if (!empty($post['message'])){
            $postMessage = explode(" ",$post['message']['text']);
           switch ($postMessage[0]){
               case '/kc':
                   $this->ApiLogic->kc($post,$bot_id);
                   break;
               case '/ad1':
               case '/ad2':
               case '/ad3':
               case '/ad4':
                   $this->ApiLogic->adGg($post,$bot_id);
                   break;
               case '/zt':
                   $this->ApiLogic->zt($post,$bot_id);
                   break;
           }
        }
        return ReturnHelper::format('success', 200, []);
    }








}
