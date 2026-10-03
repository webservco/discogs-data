<?php

declare(strict_types=1);

namespace Tests\Unit\WebServCo\DiscogsData\Data;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use WebServCo\DiscogsData\Data\Attributes;

final class AttributesTest extends TestCase
{
    #[Test]
    public function constantIdHasExpectedValue(): void
    {
        $this->assertEquals('id', Attributes::ID);
    }
}
