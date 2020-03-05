<?php
/**
 * Nextcloud - News
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author    Nils Griebner <nils@nils-griebner.de>
 * @copyright 2020 Nils Griebner
 */

namespace OCA\News\Db;

use OCP\AppFramework\Db\Entity;

class QuotaMapping extends Entity implements \JsonSerializable
{

    /** @var int */
    protected $uid;
    /** @var int */
    protected $qid;

    public function getUid() {
        return $this->uid;
    }

    public function setUid($uid): void
    {
        if ($this->uid !== $uid)
        {
            $this->uid = $uid;
            $this->markFieldUpdated('uid');
        }
    }

    public function getQid()
    {
        return $this->qid;
    }

    public function setQid($qid): void
    {
        if ($this->qid !== $qid)
        {
            $this->qid = $qid;
            $this->markFieldUpdated('qid');
        }
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'uid' => $this->uid,
            'qid' => $this->qid
        ];
    }
}