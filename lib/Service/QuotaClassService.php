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

namespace OCA\News\Service;

use OCA\News\Db\QuotaClassMapper;
use OCA\News\Db\QuotaClass;

class QuotaClassService
{
    private $mapper;

    public function __construct(QuotaClassMapper $mapper) {
        $this->mapper = $mapper;
    }

    public function findAll()
    {
        return $this->mapper->findAll();
    }

    public function find($id)
    {
        return $this->mapper->find($id);
    }

    public function create($name, $description, $bytesAllowed, $expiryDays)
    {
        //FIX-ME Validate input, catch exceptions

        $quotaClass = new QuotaClass();
        $quotaClass->setName($name);
        $quotaClass->setDescription($description);
        $quotaClass->setBytesAllowed($bytesAllowed);
        $quotaClass->setExpiryDays($expiryDays);

        return $this->mapper->insert($quotaClass);

    }

    public function delete($id)
    {
        //FIX-ME Validate input, catch exceptions

        return $this->mapper->delete($id);
    }

    public function update($id, $name, $description, $bytesAllowed, $expiryDays)
    {
        // FIX-ME Validate input, catch exceptions

        $quotaClass = new QuotaClass();
        $quotaClass->setId($id);
        $quotaClass->setName($name);
        $quotaClass->setDescription($description);
        $quotaClass->setBytesAllowed($bytesAllowed);
        $quotaClass->setExpiryDays($expiryDays);

        return $this->mapper->update($quotaClass);

    }
}
