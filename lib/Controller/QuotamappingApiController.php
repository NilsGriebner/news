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

use OCA\News\Service\QuotaMappingService;
use OCA\News\Service\ServiceConflictException;
use OCP\AppFramework\Http;
use OCP\IRequest;
use OCP\AppFramework\ApiController;


class QuotamappingApiController extends ApiController
{
    use JSONHttpError;

    private $service;
    private $userId;

    public function __construct($AppName, IRequest $request,
                                QuotaMappingService $service, $UserId)
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
     * @param string $uid
     * @param int $qid
     */
    public function create($uid, $qid)
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
     * @CORS
     * @NoCSRFRequired
     * @NoAdminRequired
     *
     * @param int $id
     * @param string $uid
     * @param int $qid
     */
    public function update($id, $uid, $qid)
    {
        return $this->service->update($id, $uid, $qid);
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