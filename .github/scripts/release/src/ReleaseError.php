<?php

declare(strict_types=1);

namespace Pipedrive\Release;

use RuntimeException;

/**
 * A release cannot go ahead. The code is the CLI exit code.
 */
final class ReleaseError extends RuntimeException
{
    /** Something is wrong: the workflow run fails. */
    public const FAILED = 1;

    /** The PR needs a developer (like a merge conflict): the workflow warns and waits. */
    public const NEEDS_DEVELOPER = 3;

    public static function needsDeveloper(string $message): self
    {
        return new self($message, self::NEEDS_DEVELOPER);
    }

    public function __construct(string $message, int $code = self::FAILED)
    {
        parent::__construct($message, $code);
    }
}
