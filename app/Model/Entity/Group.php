<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 群组
 * Class Group
 *
 * @since 2.0
 *
 * @Entity(table="group")
 */
class Group extends Model
{
    /**
     * 
     * @Id()
     * @Column()
     *
     * @var int
     */
    private $id;

    /**
     * telegram群组id
     *
     * @Column(name="chat_id", prop="chatId")
     *
     * @var int
     */
    private $chatId;

    /**
     * 群组名称
     *
     * @Column()
     *
     * @var string
     */
    private $title;

    /**
     * 状态 0:禁用 1:正常
     *
     * @Column()
     *
     * @var int
     */
    private $status;

    /**
     * 创建时间
     *
     * @Column(name="create_time", prop="createTime")
     *
     * @var string
     */
    private $createTime;

    /**
     * 修改时间
     *
     * @Column(name="update_time", prop="updateTime")
     *
     * @var string
     */
    private $updateTime;


    /**
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param int $chatId
     *
     * @return self
     */
    public function setChatId(int $chatId): self
    {
        $this->chatId = $chatId;

        return $this;
    }

    /**
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param int $status
     *
     * @return self
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @param string $createTime
     *
     * @return self
     */
    public function setCreateTime(string $createTime): self
    {
        $this->createTime = $createTime;

        return $this;
    }

    /**
     * @param string $updateTime
     *
     * @return self
     */
    public function setUpdateTime(string $updateTime): self
    {
        $this->updateTime = $updateTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getChatId(): ?int
    {
        return $this->chatId;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getCreateTime(): ?string
    {
        return $this->createTime;
    }

    /**
     * @return string
     */
    public function getUpdateTime(): ?string
    {
        return $this->updateTime;
    }

}
