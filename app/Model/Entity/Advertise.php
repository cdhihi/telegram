<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 广告表
 * Class Advertise
 *
 * @since 2.0
 *
 * @Entity(table="advertise")
 */
class Advertise extends Model
{
    /**
     * id
     * @Id()
     * @Column()
     *
     * @var int
     */
    private $id;

    /**
     * 广告名称
     *
     * @Column()
     *
     * @var string
     */
    private $name;

    /**
     * 广告链接
     *
     * @Column()
     *
     * @var string
     */
    private $link;

    /**
     * 状态 0：禁用 1：正常
     *
     * @Column()
     *
     * @var int
     */
    private $status;

    /**
     * 创建者ID
     *
     * @Column(name="create_uid", prop="createUid")
     *
     * @var int
     */
    private $createUid;

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
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $link
     *
     * @return self
     */
    public function setLink(string $link): self
    {
        $this->link = $link;

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
     * @param int $createUid
     *
     * @return self
     */
    public function setCreateUid(int $createUid): self
    {
        $this->createUid = $createUid;

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
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getCreateUid(): ?int
    {
        return $this->createUid;
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
