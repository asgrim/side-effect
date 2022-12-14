<?php

declare(strict_types=1);

namespace Asgrim\SideEffect\Features;

use Asgrim\SideEffect\CanHaveRequestInjected;
use Asgrim\SideEffect\Dispatchable;

final class WrapDispatchableInStuffAndDispatchIt implements Dispatchable
{
    public function __construct(private readonly Dispatchable $dispatchable)
    {
    }

    public function __toString(): string
    {
        $dispatchable = $this->dispatchable;

        if ($dispatchable instanceof CanHaveRequestInjected) {
            $dispatchable = new InjectsRequestDecorator($dispatchable);
        }

        /** @noinspection TypesCastingCanBeUsedInspection */

        // phpcs:ignore Squiz.Strings.DoubleQuoteUsage.ContainsVar
        return "$dispatchable";
    }
}
