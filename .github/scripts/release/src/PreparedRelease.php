<?php

declare(strict_types=1);

namespace Pipedrive\Release;

/**
 * Result of Release::prepare(): what to write and what to tell the workflow.
 */
final class PreparedRelease
{
    public Version $version;

    public Version $previous;

    /** New CHANGELOG.md contents (unchanged when the heading was already there). */
    public string $changelog;

    /** @var array<string, string> path => new contents, only filled on a major */
    public array $files = [];

    /** @var string[] */
    public array $messages = [];

    /** @var string[] */
    public array $warnings = [];

    public function isMajor(): bool
    {
        return $this->version->major !== $this->previous->major;
    }

    /**
     * Step outputs read by the workflow.
     *
     * @return array<string, string>
     */
    public function outputs(): array
    {
        return [
            'version' => (string) $this->version,
            'previous' => (string) $this->previous,
            'previous_major' => (string) $this->previous->major,
            'major' => (string) $this->version->major,
            'major_changed' => $this->isMajor() ? 'true' : 'false',
        ];
    }
}
