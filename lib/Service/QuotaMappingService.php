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

namespace Service;

use OCA\News\Db\QuotaMappingMapper;
use OCA\News\Db\QuotaMapping;

class QuotaMappingService
{
    private $mapper;

    public function __construct(QuotaMappingMapper $mapper) {
        $this->mapper = $mapper;
    }

    public function findAll()
    {
        return $this->mapper->findAll();
    }

    public function create($uid, $qid)
    {
        //FIX-ME Validate input, catch exceptions

        $quotaClass = new QuotaMapping();
        $quotaClass->setUid($uid);
        $quotaClass->setQid($qid);

        $this->mapper->insert($quotaClass);

    }

    public function delete($id)
    {
        //FIX-ME Validate input, catch exceptions

        $this->mapper->delete($id);
    }

    public function update($id, $uid, $qid)
    {
        // FIX-ME Validate input, catch exceptions

        $quotaClass = new QuotaMapping();
        $quotaClass->setId($id);
        $quotaClass->setUid($uid);
        $quotaClass->setQid($qid);

        $this->mapper->update($quotaClass);

    }
}
