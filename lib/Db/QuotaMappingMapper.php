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

use OCA\News\Db\QuotaMapping;
use OCP\AppFramework\Db\Mapper;
use OCP\IDBConnection;

class QuotaMappingMapper extends Mapper
{
    public function __construct(IDBConnection $db)
    {
        parent::__construct($db,
            'news_quota_mappings',
            QuotaMapping::class );
    }

    public function find($id)
    {
        $sql = 'SELECT * FROM `*PREFIX*news_quota_mappings`' .
            'WHERE `id` = ?';

        return $this->findEntities($sql, [$id]);
    }

    public function findAll()
    {
        $sql = 'SELECT * FROM `*PREFIX*news_quota_mappings`' ;

        return $this->findEntities($sql);
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM `*PREFIX*news_quota_mappings`' .
            'WHERE `id` = ?';

        return $this->execute($sql, [$id]);
    }
}
