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

use OCA\News\Service\ServiceConflictException;
use OCP\AppFramework\Db\DoesNotExistException;
use OCP\AppFramework\Db\MultipleObjectsReturnedException;
use OCP\AppFramework\Http;
use OCP\IRequest;
use OCP\AppFramework\ApiController;

use OCA\News\Service\QuotaClassService;

class QuotaclassApiController extends ApiController
{
    use JSONHttpError;

    private $service;

    public function __construct($AppName, IRequest $request,
                                QuotaClassService $service)
    {
        parent::__construct($AppName, $request);
        $this->service = $service;
    }

    /**
     * @CORS
     * @NoCSRFRequired
     * @NoAdminRequired
     */
    public function index()
    {
        return $this->service->findAll();
    }

    /**
     * @CORS
     * @NoCSRFRequired
     * @NoAdminRequired
     *
     * @param int $id
     */
    public function show($id)
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
     * @CORS
     * @NoCSRFRequired
     * @NoAdminRequired
     *
     * @param string $name
     * @param string $description
     * @param int $bytesAllowed
     * @param int $expiryDays
     */
    public function create($name, $description, $bytesAllowed, $expiryDays)
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
     * @CORS
     * @NoCSRFRequired
     * @NoAdminRequired
     *
     * @param int $id
     * @param string $name
     * @param string $description
     * @param int $bytesAllowed
     * @param int $expiryDays
     */
    public function update($id, $name,
                           $description,
                           $bytesAllowed,
                           $expiryDays)
    {
        return $this->service->update($id,
            $name, $description, $bytesAllowed, $expiryDays);
    }

    /**
     * @CORS
     * @NoCSRFRequired
     * @NoAdminRequired
     *
     * @param int $id
     */
    public function destroy($id)
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