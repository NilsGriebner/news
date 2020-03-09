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
use OCP\AppFramework\Db\DoesNotExistException;
use OCP\AppFramework\Db\Entity;
use OCP\AppFramework\Db\MultipleObjectsReturnedException;

class QuotaClassService
{
    private $mapper;

    public function __construct(QuotaClassMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function findAll()
    {
        return $this->mapper->findAll();
    }

    /**
     * @param $id
     * @return Entity
     * @throws \OCP\AppFramework\Db\DoesNotExistException
     * @throws \OCP\AppFramework\Db\MultipleObjectsReturnedException
     */
    public function find($id)
    {
        return $this->mapper->find($id);
    }

    /**
     * @param $name
     * @param $description
     * @param $bytesAllowed
     * @param $expiryDays
     * @return Entity
     * @throws ServiceConflictException
     */
    public function create($name, $description, $bytesAllowed, $expiryDays)
    {
        $exceptionMessage = "Quota class with name already exists!";
        try
        {
            $existingQuotaClass = $this->mapper->findByName($name);

            if ($existingQuotaClass !== null)
            {
                throw new ServiceConflictException($exceptionMessage);
            }
        } catch (DoesNotExistException $e)
        {
            $quotaClass = new QuotaClass();
            $quotaClass->setName($name);
            $quotaClass->setDescription($description);
            $quotaClass->setBytesAllowed($bytesAllowed);
            $quotaClass->setExpiryDays($expiryDays);

            return $this->mapper->insert($quotaClass);

        } catch (MultipleObjectsReturnedException $e) {
            throw new ServiceConflictException($exceptionMessage);
        }
    }

    /**
     * @param $id
     * @return Entity
     * @throws DoesNotExistException
     * @throws MultipleObjectsReturnedException
     */
    public function delete($id)
    {
        $quotaClass = $this->find($id);
        return $this->mapper->delete($quotaClass);
    }

    public function update($id, $name, $description, $bytesAllowed, $expiryDays)
    {
        $quotaClass = new QuotaClass();
        $quotaClass->setId($id);
        $quotaClass->setName($name);
        $quotaClass->setDescription($description);
        $quotaClass->setBytesAllowed($bytesAllowed);
        $quotaClass->setExpiryDays($expiryDays);

        return $this->mapper->update($quotaClass);

    }
}
