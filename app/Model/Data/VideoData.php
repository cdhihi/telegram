<?php declare(strict_types=1);


namespace App\Model\Data;

use App\Exception\ApiException;
use App\Model\Dao\VideoDao;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * 视频数据
 * Class VideoData
 * @package App\Model\Data
 * @Bean()
 */
class VideoData
{
    /**
     * @Inject()
     * @var VideoDao
     */
    private $VideoDao;

    //获取广告列表
    public function getVideos()
    {


        $Videos = $this->VideoDao->getVideos();

        return empty($Videos) ? [] : $Videos->toArray();
    }

    public function getVideo(int $id)
    {
        $Videos = $this->VideoDao->getVideo($id);
        return empty($Videos) ? [] : $Videos->toArray();
    }

    public function getUserByName(string $name)
    {
        return $this->VideoDao->getVideoByName($name);

    }


    public function getVideoByType(int $type)
    {
        return $this->VideoDao->getVideoByType($type);

    }





    public function issetUserById(string $uid): bool
    {
        return (bool)$this->VideoDao->getUser((int)$uid);
    }

    public function createVideo(array $VideoInfo)
    {
        $isVideoInfo = $this->getUserByName($VideoInfo['name']);
        if ($isVideoInfo) {
            throw new ApiException('User already exist', 400);
        }
        return $this->VideoDao->createVideo($VideoInfo);
    }



    public function updateVideo(int $id, array $VideoInfo)
    {
        return $this->VideoDao->updateVideo($id, $VideoInfo);
    }
}
