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
use PHPUnit\Framework\TestCase;

class QuotamappingTest extends TestCase
{
    public function testJsonSerialize()
    {
        $quotaMapping = new QuotaMapping();
        $quotaMapping->setId(3);
        $quotaMapping->setUid('test');
        $quotaMapping->setQid(8);

        $this->assertEquals(
            [
                'id' => 3,
                'uid' => 'test',
                'qid' => 8,
            ], $quotaMapping->jsonSerialize()
        );
    }

}
