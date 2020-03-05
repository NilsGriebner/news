<?php

/**
 * Nextcloud - News
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author    Alessandro Cosentino <cosenal@gmail.com>
 * @author    Bernhard Posselt <dev@bernhard-posselt.com>
 * @copyright 2012 Alessandro Cosentino
 * @copyright 2012-2014 Bernhard Posselt
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
