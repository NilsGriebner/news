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

use OCA\News\Db\QuotaClass;
use OCA\News\Db\QuotaClassMapper;
use OCP\AppFramework\Db\DoesNotExistException;
use OCP\AppFramework\Db\MultipleObjectsReturnedException;

class QuotaclassMapperTest extends MapperTestUtility
{
    private $quotaClasses;
    private $quotaclassMapper;
    private $twoRows;
    private $oneRow;

    protected function setUp()
    {
        parent::setUp();

        $this->quotaclassMapper = new QuotaClassMapper($this->db);

        $quotaClass1 = new QuotaClass();
        $quotaClass1->setId(4);
        $quotaClass1->setName("test");
        $quotaClass1->resetUpdatedFields();

        $quotaClass2 = new QuotaClass();
        $quotaClass2->setName("bla");
        $quotaClass2->setId(5);
        $quotaClass2->resetUpdatedFields();

        $this->quotaClasses = [$quotaClass1,$quotaClass2];
        $this->twoRows = [
            ['id' => $this->quotaClasses[0]->getId()],
            ['id' => $this->quotaClasses[1]->getId()]
        ];
        $this->oneRow = [
            ['id' => $this->quotaClasses[0]->getId(), "name" => "test"]
        ];
    }

    public function testFind()
    {
        $id = 4;
        $rows = [['id' => $this->quotaClasses[0]->getId(), "name"=> "test"]];
        $sql = 'SELECT * FROM `*PREFIX*news_quota_classes`' .
            'WHERE `id` = ?';

        $this->setMapperResult($sql, [$id], $rows);

        $result = $this->quotaclassMapper->find($id);
        $this->assertEquals($this->quotaClasses[0], $result);

    }

    public function testFindNotFound()
    {
        $id = 4;
        $sql = 'SELECT * FROM `*PREFIX*news_quota_classes`' .
            'WHERE `id` = ?';

        $this->setMapperResult($sql, [$id]);

        $this->expectException(DoesNotExistException::class);
        $this->quotaclassMapper->find($id);
    }

    public function testFindMoreThanOneResultFound()
    {
        $id = 4;
        $rows = $this->twoRows;
        $sql = 'SELECT * FROM `*PREFIX*news_quota_classes`' .
            'WHERE `id` = ?';

        $this->setMapperResult($sql, [$id], $rows);

        $this->expectException(MultipleObjectsReturnedException::class);
        $this->quotaclassMapper->find($id);
    }

    public function testFindByName()
    {
        $quotaClassName = 'test';
        $rows = $this->oneRow;
        $sql = 'SELECT * FROM `*PREFIX*news_quota_classes`' .
            'WHERE `name` = ?';

        $this->setMapperResult($sql, [$quotaClassName], $rows);

        $result = $this->quotaclassMapper->findByName($quotaClassName);
        $this->assertEquals($this->quotaClasses[0], $result);
    }

    public function testDelete()
    {
        $quotaClass = new QuotaClass();
        $quotaClass->setId(3);

        $sql = 'DELETE FROM `*PREFIX*news_quota_classes` WHERE `id` = ?';
        $arguments = [$quotaClass->getId()];

        $this->setMapperResult($sql, $arguments, [], null, null, true);

        $this->quotaclassMapper->delete($quotaClass);
    }
}