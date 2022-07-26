<?php declare(strict_types=1);


namespace App\Model\Data;

use App\Exception\ApiException;
use App\Model\Dao\AdvertiseDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * 广告数据
 * Class AdvertiseData
 * @package App\Model\Data
 * @Bean()
 */
class AdvertiseData
{
    /**
     * @Inject()
     * @var AdvertiseDao
     */
    private $advertiseDao;

    //获取广告列表
    public function getAdvertises()
    {
        $advertises = $this->advertiseDao->getAdvertises();
        return empty($advertises) ? [] : $advertises->toArray();
    }

    public function getAdvertise(int $id)
    {
        $advertises = $this->advertiseDao->getAdvertise($id);
        return empty($advertises) ? [] : $advertises->toArray();
    }

    public function getUserByName(string $name)
    {
        return $this->advertiseDao->getAdvertiseByName($name);

        return $this->advertiseDao->getAdvertiseByIdentify($identify);
    }

    public function issetUserById(string $uid): bool
    {
        return (bool)$this->advertiseDao->getUser((int)$uid);
    }

    public function createAdvertise(array $advertiseInfo)
    {
        $isAdvertiseInfo = $this->getUserByName($advertiseInfo['name']);
        if ($isAdvertiseInfo) {
            throw new ApiException('User already exist', 400);
        }
        return $this->advertiseDao->createAdvertise($advertiseInfo);
    }


//    /**
//     * 创建用户
//     * @param array $userInfo
//     * @param string $token
//     * @param array $clientInfo
//     * @return bool
//     * @throws ApiException
//     */
//    public function createAdvertise(array $userInfo, string $token, array $clientInfo)
//    {
//        /** @var AuthSession $session */
//        $userInfo['create_uid']  = $session->getIdentity();
//        $userInfo['status']      = 1;
//        $userInfo['create_time'] = date('Y-m-d H:i:s');
//        $userInfo['ip']          = $clientInfo['remote_addr'];
//        $userInfo['login_name']  = $userInfo['identity'];
//        $userInfo['password']    = $this->createCredential($userInfo);
//        $roleIds                 = $userInfo['role_ids'];
//        unset($userInfo['role_ids']);
//        unset($userInfo['identity']);
//        unset($userInfo['credential']);
//        $ret = $this->userData->createUser($userInfo);
//        if ($ret) {
//            $userRoleMapping = $this->createUserRoleMapping((int)$ret, $roleIds);
//            $this->userRoleData->createUserRoleMapping($userRoleMapping);
//        }
//
//        return $ret;
//    }

    public function updateAdvertise(int $id, array $advertiseInfo)
    {
        return $this->advertiseDao->updateAdvertise($id, $advertiseInfo);
    }
}
