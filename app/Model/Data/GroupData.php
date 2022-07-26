<?php declare(strict_types=1);


namespace App\Model\Data;

use App\Exception\ApiException;
use App\Model\Dao\GroupDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * 群数据
 * Class GroupData
 * @package App\Model\Data
 * @Bean()
 */
class GroupData
{
    /**
     * @Inject()
     * @var GroupDao
     */
    private $GroupDao;

    //获取广告列表
    public function getGroups()
    {


        $Groups = $this->GroupDao->getGroups();

        return empty($Groups) ? [] : $Groups->toArray();
    }

    public function getGroup(int $id)
    {
        $Groups = $this->GroupDao->getGroup($id);
        return empty($Groups) ? [] : $Groups->toArray();
    }

    public function getGroupByName(string $name)
    {
        return $this->GroupDao->getGroupByName($name);

    }

    public function issetGroupById(string $uid): bool
    {
        return (bool)$this->GroupDao->getGroup((int)$uid);
    }

    public function createGroup(array $GroupInfo)
    {
        $isGroupInfo = $this->getGroupByName($GroupInfo['name']);
        if ($isGroupInfo) {
            throw new ApiException('Group already exist', 400);
        }
        return $this->GroupDao->createGroup($GroupInfo);
    }



    public function updateGroup(int $id, array $GroupInfo)
    {
        return $this->GroupDao->updateGroup($id, $GroupInfo);
    }
}
