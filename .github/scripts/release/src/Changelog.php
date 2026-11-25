<?php

declare(strict_types=1);

namespace Pipedrive\Release;

/**
 * Reads and edits CHANGELOG.md. Immutable: edits return the new text.
 */
final class Changelog
{
    private const UNRELEASED = '/^## \[Unreleased\]/';
    private const RELEASED = '/^## \[(\d+\.\d+\.\d+)\]/';
    private const ANY_SECTION = '/^## \[/';

    /** @var string[] */
    private readonly array $lines;

    public function __construct(string $text)
    {
        $this->lines = explode("\n", $text);
    }

    public function hasUnreleasedSection(): bool
    {
        return $this->unreleasedIndex() !== null;
    }

    /** Newest released version, from the first "## [X.Y.Z]" heading. */
    public function latestVersion(): ?Version
    {
        foreach ($this->lines as $line) {
            if (preg_match(self::RELEASED, $line, $match) === 1) {
                return Version::parse($match[1]);
            }
        }

        return null;
    }

    public function hasUnreleasedEntries(): bool
    {
        foreach ($this->unreleasedLines() as $line) {
            if (trim($line) !== '') {
                return true;
            }
        }

        return false;
    }

    /**
     * Top-level "- " entries under Unreleased that already exist under a released version.
     * This happens when two bot PRs were generated from the same master: git merges the
     * second one cleanly, but its Unreleased section repeats the notes of the first.
     *
     * @return string[]
     */
    public function repeatedEntries(): array
    {
        $entries = ['unreleased' => [], 'released' => []];
        $section = null;
        foreach ($this->lines as $line) {
            if (preg_match(self::UNRELEASED, $line) === 1) {
                $section = 'unreleased';
            } elseif (preg_match(self::ANY_SECTION, $line) === 1) {
                $section = 'released';
            } elseif ($section !== null && str_starts_with($line, '- ')) {
                $entries[$section][$line] = true;
            }
        }

        return array_keys(array_intersect_key($entries['unreleased'], $entries['released']));
    }

    /**
     * Adds the version heading the same way the manual releases did: "## [Unreleased]",
     * a blank line, then the heading directly above the entries that were under Unreleased.
     */
    public function withReleaseHeading(Version $version, Version $previous, string $date, string $repoUrl): string
    {
        $index = $this->unreleasedIndex();
        if ($index === null) {
            throw new ReleaseError("CHANGELOG.md has no '## [Unreleased]' heading");
        }

        $rest = array_slice($this->lines, $index + 1);
        while ($rest !== [] && trim($rest[0]) === '') {
            array_shift($rest);
        }

        return implode("\n", [
            ...array_slice($this->lines, 0, $index + 1),
            '',
            self::heading($version, $previous, $date, $repoUrl),
            ...$rest,
        ]);
    }

    public static function heading(Version $version, Version $previous, string $date, string $repoUrl): string
    {
        return "## [{$version}]({$repoUrl}/compare/{$previous}...{$version}) ({$date})";
    }

    private function unreleasedIndex(): ?int
    {
        foreach ($this->lines as $index => $line) {
            if (preg_match(self::UNRELEASED, $line) === 1) {
                return $index;
            }
        }

        return null;
    }

    /** @return string[] lines between "## [Unreleased]" and the next "## [" heading */
    private function unreleasedLines(): array
    {
        $index = $this->unreleasedIndex();
        if ($index === null) {
            return [];
        }
        $lines = [];
        foreach (array_slice($this->lines, $index + 1) as $line) {
            if (preg_match(self::ANY_SECTION, $line) === 1) {
                break;
            }
            $lines[] = $line;
        }

        return $lines;
    }
}
