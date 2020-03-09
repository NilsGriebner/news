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

namespace OCA\News\Tests\Unit\Db;

use OCA\News\Db\QuotaMapping;
use OCA\News\Db\QuotaMappingMapper;
use OCP\AppFramework\Db\DoesNotExistException;
use OCP\AppFramework\Db\MultipleObjectsReturnedException;

class QuotamappingMapperTest extends MapperTestUtility
{
    private $quotamappingMapper;
    private $quotaMappings;
    private $twoRows;
    private $oneRow;

    protected function setUp()
    {
        parent::setUp();

        $this->quotamappingMapper = new QuotaMappingMapper($this->db);

        $quotaMapping1 = new QuotaMapping();
        $quotaMapping1->setId(4);
        $quotaMapping1->setUid("test");
        $quotaMapping1->resetUpdatedFields();

        $quotaMapping2= new QuotaMapping();
        $quotaMapping2->setUid("bla");
        $quotaMapping2->setId(5);
        $quotaMapping2->resetUpdatedFields();

        $this->quotaMappings = [$quotaMapping1,$quotaMapping2];
        $this->twoRows = [
            ['id' => $this->quotaMappings[0]->getId()],
            ['id' => $this->quotaMappings[1]->getId()]
        ];
        $this->oneRow = [
            ['id' => $this->quotaMappings[0]->getId(), "uid" => "test"]
        ];
    }

    public function testFind()
    {
        $id = 4;
        $rows = [['id' => $this->quotaMappings[0]->getId(), "uid"=> "test"]];
        $sql = 'SELECT * FROM `*PREFIX*news_quota_mappings`' .
            'WHERE `id` = ?';

        $this->setMapperResult($sql, [$id], $rows);

        $result = $this->quotamappingMapper->find($id);
        $this->assertEquals($this->quotaMappings[0], $result);

    }

    public function testFindNotFound()
    {
        $id = 4;
        $sql = 'SELECT * FROM `*PREFIX*news_quota_mappings`' .
            'WHERE `id` = ?';

        $this->setMapperResult($sql, [$id]);

        $this->expectException(DoesNotExistException::class);
        $this->quotamappingMapper->find($id);
    }

    public function testFindMoreThanOneResultFound()
    {
        $id = 4;
        $rows = $this->twoRows;
        $sql = 'SELECT * FROM `*PREFIX*news_quota_mappings`' .
            'WHERE `id` = ?';

        $this->setMapperResult($sql, [$id], $rows);

        $this->expectException(MultipleObjectsReturnedException::class);
        $this->quotamappingMapper->find($id);
    }

    public function testFindByUid()
    {
        $quotaMappingName = 'test';
        $rows = $this->oneRow;
        $sql = 'SELECT * FROM `*PREFIX*news_quota_mappings`' .
            'WHERE `uid` = ?';

        $this->setMapperResult($sql, [$quotaMappingName], $rows);

        $result = $this->quotamappingMapper->findByUid($quotaMappingName);
        $this->assertEquals($this->quotaMappings[0], $result);
    }

    public function testDelete()
    {
        $quotaMapping = new QuotaMapping();
        $quotaMapping->setId(3);

        $sql = 'DELETE FROM `*PREFIX*news_quota_mappings` WHERE `id` = ?';
        $arguments = [$quotaMapping->getId()];

        $this->setMapperResult($sql, $arguments, [], null, null, true);

        $this->quotamappingMapper->delete($quotaMapping);
    }
}