<?php

declare(strict_types=1);

namespace Asgrim\SideEffect;

use Asgrim\SideEffect\Features\WrapDispatchableInStuffAndDispatchIt;
use Psr\Http\Message\ServerRequestInterface;
use Stringable;

use function array_reduce;

final class Framework implements Stringable
{
    /** @var array<string,mixed> */
    public static array $dumpingGround;

    /**
     * @param list<Dispatchable> $dispatchables
     */
    public function __construct(
        ServerRequestInterface $request,
        private array $dispatchables
    ) {
        self::$dumpingGround[ServerRequestInterface::class] = $request;
    }

    public function __toString(): string
    {
        return array_reduce(
            $this->dispatchables,
            static function (string $carry, Dispatchable $dispatchable): string {
                return $carry . new WrapDispatchableInStuffAndDispatchIt($dispatchable);
            },
            ''
        );
    }
}
