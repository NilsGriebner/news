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
use OCP\AppFramework\Controller;

use OCA\News\Service\QuotaClassService;

class QuotaClassController extends Controller
{

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
     */
    public function index()
    {
        return $this->service->findAll();
    }

    /**
     * @NoAdminRequired
     *
     * @param int $id
     */
    public function show(int $id)
    {
        return $this->service->find($id);
    }

    /**
     * @NoAdminRequired
     *
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
        return $this->service->create($name,
            $description, $bytesAllowed, $expiryDays);
    }

    /**
     * @NoAdminRequired
     *
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
     *
     * @param int $id
     */
    public function destroy(int $id)
    {
        return $this->service->delete($id);
    }
}