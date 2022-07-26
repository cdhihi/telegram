<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 视频表
 * Class Video
 *
 * @since 2.0
 *
 * @Entity(table="video")
 */
class Video extends Model
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
     * 视频名称
     *
     * @Column()
     *
     * @var string
     */
    private $name;

    /**
     * 视频地址
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
     * 视频封面
     *
     * @Column()
     *
     * @var string
     */
    private $image;

    /**
     * 描述
     *
     * @Column()
     *
     * @var string
     */
    private $describe;

    /**
     * 创建时间
     *
     * @Column(name="create_time", prop="createTime")
     *
     * @var string
     */
    private $createTime;



    /**
     *  类型 1短视频，2长视频
     *
     * @Column()
     *
     * @var int
     */
    private $type;





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
     * @param int $type
     *
     * @return self
     */
    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }


    /**
     * @param string $image
     *
     * @return self
     */
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @param string $describe
     *
     * @return self
     */
    public function setDescribe(string $describe): self
    {
        $this->describe = $describe;

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
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getType(): ?int
    {
        return $this->type;
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
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getDescribe(): ?string
    {
        return $this->describe;
    }

    /**
     * @return string
     */
    public function getCreateTime(): ?string
    {
        return $this->createTime;
    }

}
