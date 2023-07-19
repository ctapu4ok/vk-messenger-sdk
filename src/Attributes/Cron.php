<?php
declare(strict_types=1);

namespace ctapu4ok\VkMessengerSdk\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
final readonly class Cron
{
    public function __construct(
        public float $period
    ) {
    }
}
