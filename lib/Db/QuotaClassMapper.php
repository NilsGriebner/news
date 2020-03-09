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

namespace OCA\News\Db;

use OCP\AppFramework\Db\Mapper;
use OCP\IDBConnection;

class QuotaClassMapper extends Mapper
{
    public function __construct(IDBConnection $db)
    {
        parent::__construct($db,
            'news_quota_classes',
            QuotaClass::class );
    }

    /**
     * @param $id
     * @return \OCP\AppFramework\Db\Entity
     * @throws \OCP\AppFramework\Db\DoesNotExistException
     * @throws \OCP\AppFramework\Db\MultipleObjectsReturnedException
     */
    public function find($id)
    {
        $sql = 'SELECT * FROM `*PREFIX*news_quota_classes`' .
            'WHERE `id` = ?';

        return $this->findEntity($sql, [$id]);
    }

    public function findAll()
    {
        $sql = 'SELECT * FROM `*PREFIX*news_quota_classes`' ;

        return $this->findEntities($sql);
    }

    /**
     * @param $name
     * @return \OCP\AppFramework\Db\Entity
     * @throws \OCP\AppFramework\Db\DoesNotExistException
     * @throws \OCP\AppFramework\Db\MultipleObjectsReturnedException
     */
    public function findByName($name)
    {
        $sql = 'SELECT * FROM `*PREFIX*news_quota_classes`' .
            'WHERE `name` = ?';

        return $this->findEntity($sql, [$name]);
    }
}
