<?php

declare(strict_types=1);

namespace Asgrim\SideEffect\Features;

use Asgrim\SideEffect\Dispatchable;
use Throwable;

final class ShutTheHellUpDecorator implements Dispatchable
{
    public function __construct(private Dispatchable $realDispatchable)
    {
    }

    public function __toString(): string
    {
        try {
            /** @noinspection PhpExpressionResultUnusedInspection */
            (string) ($this->realDispatchable);
        } catch (Throwable $ignored) {
            // This is a feature
        }

        return '';
    }
}
