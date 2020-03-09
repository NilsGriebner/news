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
use PHPUnit\Framework\TestCase;

class QuotaclassTest extends TestCase
{
    public function testJsonSerialize()
    {
        $quotaClass = new QuotaClass();
        $quotaClass->setId(3);
        $quotaClass->setName('testclass');
        $quotaClass->setDescription('test');
        $quotaClass->setBytesAllowed(1234);
        $quotaClass->setExpiryDays(7);

        $this->assertEquals(
            [
                'id' => 3,
                'name' => 'testclass',
                'description' => 'test',
                'bytesAllowed' => 1234,
                'expiryDays' => 7,
            ], $quotaClass->jsonSerialize()
        );
    }

}
