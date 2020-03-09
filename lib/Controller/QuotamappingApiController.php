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
use OCP\AppFramework\Db\DoesNotExistException;
use OCP\AppFramework\Db\MultipleObjectsReturnedException;
use OCP\AppFramework\Http;
use OCP\IRequest;
use OCP\AppFramework\ApiController;


class QuotamappingApiController extends ApiController
{
    use JSONHttpError;

    private $service;

    public function __construct($AppName, IRequest $request,
                                QuotaMappingService $service)
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