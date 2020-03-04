<?php
namespace OCA\News\Db;

use OCP\AppFramework\Db\Entity;

class QuotaClass extends Entity implements \JsonSerializable {

    /** @var int */
    protected $id;
    /** @var string */
    protected $name;
    /** @var string */
    protected $description;
    /** @var int */
    protected $bytesAllowed;
    /** @var int */
    protected $expiryDays;

    public function getId() {
        return $this->id;
    }

    public function setId( int $id): void {
        if ($this->id !== $id) {
            $this->id = $id;
            $this->markFieldUpdated('id');
        }
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name): void {
        if ($this->name !== $name) {
            $this->name = $name;
            $this->markFieldUpdated('name');
        }
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description): void {
        if ($this->description !== $description) {
            $this->description = $description;
            $this->markFieldUpdated('description');
        }
    }

    public function getBytesAllowed() {
        return $this->bytesAllowed;
    }

    public function setBytesAllowed($bytesAllowed): void {
        if ($this->bytesAllowed !== $bytesAllowed) {
            $this->bytesAllowed = $bytesAllowed;
            $this->markFieldUpdated('bytesAllowed');
        }
    }

    public function getExpiryDays() {
        return $this->expiryDays;
    }

    public function setExpiryDays($expiryDays): void {
        if ($this->expiryDays !== $expiryDays) {
            $this->expiryDays = $expiryDays;
            $this->markFieldUpdated('expiryDays');
        }
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'bytesAllowed' => $this->bytesAllowed,
            'expiryDate' => $this->expiryDays
        ];
    }
}