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

namespace OCA\News\Controller;

use OCA\Files_External\NotFoundException;
use OCA\News\Service\ServiceConflictException;
use OCP\AppFramework\Db\DoesNotExistException;
use OCP\AppFramework\Db\MultipleObjectsReturnedException;
use OCP\AppFramework\Http;
use OCP\IRequest;
use OCP\AppFramework\Controller;

use OCA\News\Service\QuotaClassService;

class QuotaclassController extends Controller
{
    use JSONHttpError;

    private $service;
    private $userId;

    public function __construct(string $AppName, IRequest $request,
                                QuotaClassService $service, $UserId)
    {
        parent::__construct($AppName, $request);
        $this->service = $service;
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     */
    public function index()
    {
        return $this->service->findAll();
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     * @param int $id
     */
    public function show(int $id)
    {
        try
        {
            return $this->service->find($id);
        } catch (DoesNotExistException $e)
        {
           return $this->error($e, Http::STATUS_NOT_FOUND);
        } catch (MultipleObjectsReturnedException $e)
        {
            return $this->error($e, Http::STATUS_CONFLICT);
        }
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     * @param string $name
     * @param string $description
     * @param int $bytesAllowed
     * @param int $expiryDays
     */
    public function create(string $name,
                           string $description,
                           int $bytesAllowed,
                           int $expiryDays)
    {
        try
        {
            return $this->service->create($name,
                $description, $bytesAllowed, $expiryDays);
        } catch (ServiceConflictException $e)
        {
            return $this->error($e ,Http::STATUS_CONFLICT);
        }
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     * @param int $id
     * @param string $name
     * @param string $description
     * @param int $bytesAllowed
     * @param int $expiryDays
     */
    public function update(int $id,
                           string $name,
                           string $description,
                           int $bytesAllowed,
                           int $expiryDays)
    {
        return $this->service->update($id, $name, $description, $bytesAllowed, $expiryDays);
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param int $id
     */
    public function destroy(int $id)
    {
        try
        {
            return $this->service->delete($id);
        } catch (DoesNotExistException $e)
        {
            return $this->error($e, Http::STATUS_NOT_FOUND);
        } catch (MultipleObjectsReturnedException $e)
        {
            return $this->error($e,http::STATUS_CONFLICT);
        }
    }
}