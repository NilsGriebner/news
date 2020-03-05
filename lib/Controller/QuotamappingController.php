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
use OCP\IRequest;
use OCP\AppFramework\Http;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;

use OCA\News\Service\QuotaMappingService;

class QuotamappingController extends Controller
{
    use JSONHttpError;

    private $service;
    private $userId;

    public function __construct(string $AppName, IRequest $request,
                                QuotaMappingService $service, $UserId)
    {
        parent::__construct($AppName, $request);
        $this->service = $service;
        $this->userId = $UserId;
    }

    /**
     * @NoCSRFRequired
     * @NoAdminRequired
     */
    public function index()
    {
        return new DataResponse($this->service->findAll());
    }

    /**
     * @NoCSRFRequired
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
     * @NoCSRFRequired
     *
     * @param string $uid
     * @param int $qid
     */
    public function create(string $uid, int $qid)
    {
        try
        {
            return $this->service->create($uid, $qid);

        } catch (ServiceConflictException $e)
        {
            return $this->error($e, Http::STATUS_CONFLICT);
        }
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param int $id
     * @param string $uid
     * @param int $qid
     */
    public function update(int $id,
                           string $uid,
                           int $qid)
    {
        return $this->service->update($id, $uid, $qid);
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param int $id
     */
    public function destroy(int $id)
    {
        return $this->service->delete($id);
    }
}