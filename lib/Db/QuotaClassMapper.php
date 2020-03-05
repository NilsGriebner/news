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

    public function find($id)
    {
        $sql = 'SELECT * FROM `*PREFIX*news_quota_classes`' .
            'WHERE `id` = ?';

        return $this->findEntities($sql, [$id]);
    }

    public function findAll()
    {
        $sql = 'SELECT * FROM `*PREFIX*news_quota_classes`' ;

        return $this->findEntities($sql);
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM `*PREFIX*news_quota_classes`' .
            'WHERE `id` = ?';

        return $this->execute($sql, [$id]);
    }

    public function findByName($name)
    {
        $sql = 'SELECT * FROM `*PREFIX*news_quota_classes`' .
            'WHERE `name` = ?';

        return $this->findEntities($sql, [$name]);
    }
}
