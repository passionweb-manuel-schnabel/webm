<?php

declare(strict_types=1);

namespace Passionweb\Webm\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class QueueItem extends AbstractEntity
{
    protected int $hidden = 0;
    protected string $tablenames = '';
    protected string $fieldname = '';
    protected int $uidForeign = 0;
    protected int $sysFileUid = 0;
    protected int $status = 0;


    public function getHidden(): int
    {
        return $this->hidden;
    }

    public function setHidden(int $hidden): void
    {
        $this->hidden = $hidden;
    }

    public function getTablenames(): string
    {
        return $this->tablenames;
    }

    public function setTablenames(string $tablenames): void
    {
        $this->tablenames = $tablenames;
    }

    public function getFieldname(): string
    {
        return $this->fieldname;
    }

    public function setFieldname(string $fieldname): void
    {
        $this->fieldname = $fieldname;
    }

    public function getUidForeign(): int
    {
        return $this->uidForeign;
    }

    public function setUidForeign(int $uidForeign): void
    {
        $this->uidForeign = $uidForeign;
    }

    public function getSysFileUid(): int
    {
        return $this->sysFileUid;
    }

    public function setSysFileUid(int $sysFileUid): void
    {
        $this->sysFileUid = $sysFileUid;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }
}
