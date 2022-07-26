<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class Bot
 *
 * @since 2.0
 *
 * @Entity(table="bot")
 */
class Bot extends Model
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
     * bot名称
     *
     * @Column()
     *
     * @var string
     */
    private $name;

    /**
     * bot的用户名
     *
     * @Column()
     *
     * @var string
     */
    private $username;

    /**
     * botkey
     *
     * @Column(name="key", prop="propertyKey")
     *
     * @var string
     */
    private $propertyKey;

    /**
     * 创建时间
     *
     * @Column(name="create_time", prop="createTime")
     *
     * @var string
     */
    private $createTime;

    /**
     * 状态 0：禁用 1：正常
     *
     * @Column()
     *
     * @var int
     */
    private $status;


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
     * @param string $username
     *
     * @return self
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @param string $propertyKey
     *
     * @return self
     */
    public function setPropertyKey(string $propertyKey): self
    {
        $this->propertyKey = $propertyKey;

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
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPropertyKey(): ?string
    {
        return $this->propertyKey;
    }

    /**
     * @return string
     */
    public function getCreateTime(): ?string
    {
        return $this->createTime;
    }

    /**
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

}
