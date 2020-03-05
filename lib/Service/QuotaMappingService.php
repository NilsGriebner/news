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

use OCA\News\Db\QuotaMappingMapper;
use OCA\News\Db\QuotaMapping;

class QuotaMappingService
{
    private $mapper;

    public function __construct(QuotaMappingMapper $mapper)
    {
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

    /**
     * @param $uid
     * @param $qid
     * @return \OCP\AppFramework\Db\Entity
     * @throws ServiceConflictException
     */
    public function create($uid, $qid)
    {
        $existingQuotaMapping = $this->mapper->findByUid($uid);
        if (count($existingQuotaMapping) > 0)
        {
            throw new ServiceConflictException("Quota mapping for user exists!");
        }

        $quotaMapping = new QuotaMapping();
        $quotaMapping->setUid($uid);
        $quotaMapping->setQid($qid);

        return $this->mapper->insert($quotaMapping);

    }

    public function delete($id)
    {
        return $this->mapper->delete($id);
    }

    public function update($id, $uid, $qid)
    {
        $quotaClass = new QuotaMapping();
        $quotaClass->setId($id);
        $quotaClass->setUid($uid);
        $quotaClass->setQid($qid);

        return $this->mapper->update($quotaClass);

    }
}
