<?php
namespace OCA\News\Db;

use OCP\AppFramework\Db\Entity;

class QuotaMapping extends Entity implements \JsonSerializable {

    /** @var int */
    protected $id;
    /** @var int */
    protected $uid;
    /** @var int */
    protected $qid;

    public function getId() {
        return $this->id;
    }

    public function setId( int $id): void {
        if ($this->id !== $id) {
            $this->id = $id;
            $this->markFieldUpdated('id');
        }
    }

    public function getUid() {
        return $this->uid;
    }

    public function setUid($uid): void {
        if ($this->uid !== $uid) {
            $this->uid = $uid;
            $this->markFieldUpdated('uid');
        }
    }

    public function getQid() {
        return $this->qid;
    }

    public function setQid($qid): void {
        if ($this->qid !== $qid) {
            $this->qid = $qid;
            $this->markFieldUpdated('qid');
        }
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'uid' => $this->uid,
            'qid' => $this->qid
        ];
    }
}