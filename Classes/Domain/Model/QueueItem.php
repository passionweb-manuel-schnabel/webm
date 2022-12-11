<?php

declare(strict_types=1);

namespace Passionweb\Webm\Domain\Model;


use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class QueueItem extends AbstractEntity
{
    /**
     *
     * @var boolean
     */
    protected $hidden = 0;

    /**
     *
     * @var string
     */
    protected $tablenames = '';

    /**
     *
     * @var string
     */
    protected $fieldname = '';

    /**
     *
     * @var int
     */
    protected $uidForeign = 0;

    /**
     *
     * @var int
     */
    protected $sysFileUid = 0;

    /**
     *
     * @var int
     */
    protected $status = 0;

    /**
     * @return bool|int
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * @param bool|int $hidden
     */
    public function setHidden($hidden): void
    {
        $this->hidden = $hidden;
    }

    /**
     * @return string
     */
    public function getTablenames(): string
    {
        return $this->tablenames;
    }

    /**
     * @param string $tablenames
     */
    public function setTablenames(string $tablenames): void
    {
        $this->tablenames = $tablenames;
    }

    /**
     * @return string
     */
    public function getFieldname(): string
    {
        return $this->fieldname;
    }

    /**
     * @param string $fieldname
     */
    public function setFieldname(string $fieldname): void
    {
        $this->fieldname = $fieldname;
    }

    /**
     * @return int
     */
    public function getUidForeign(): int
    {
        return $this->uidForeign;
    }

    /**
     * @param int $uidForeign
     */
    public function setUidForeign(int $uidForeign): void
    {
        $this->uidForeign = $uidForeign;
    }

    /**
     * @return int
     */
    public function getSysFileUid(): int
    {
        return $this->sysFileUid;
    }

    /**
     * @param int $sysFileUid
     */
    public function setSysFileUid(int $sysFileUid): void
    {
        $this->sysFileUid = $sysFileUid;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}
