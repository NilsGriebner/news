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

use OCP\IRequest;
use OCP\AppFramework\ApiController;

use OCA\News\Service\QuotaClassService;

class QuotaClassApiController extends ApiController {

    private $service;
    private $userId;

    public function __construct($AppName, IRequest $request,
                                QuotaClassService $service, $UserId)
    {
        parent::__construct($AppName, $request);
        $this->service = $service;
        $this->userId = $UserId;
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
        return $this->service->find($id);
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
        return $this->service->create($name,
            $description, $bytesAllowed, $expiryDays);
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
        return $this->service->delete($id);
    }

}