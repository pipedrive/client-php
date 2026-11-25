<?php

declare(strict_types=1);

namespace Pipedrive\Release;

/**
 * A release version, X.Y.Z (tags have no "v" prefix).
 */
final class Version
{
    private function __construct(
        public readonly int $major,
        public readonly int $minor,
        public readonly int $patch
    ) {
    }

    public static function isValid(string $version): bool
    {
        return preg_match('/^\d+\.\d+\.\d+$/', $version) === 1;
    }

    public static function parse(string $version): self
    {
        if (!self::isValid($version)) {
            throw new ReleaseError("'{$version}' is not an X.Y.Z version");
        }
        [$major, $minor, $patch] = array_map('intval', explode('.', $version));

        return new self($major, $minor, $patch);
    }

    /**
     * Highest X.Y.Z tag, ignoring tags like 5.0.0-beta.1.
     *
     * @param string[] $tags
     */
    public static function latest(array $tags): ?self
    {
        $versions = array_map(
            [self::class, 'parse'],
            array_values(array_filter($tags, [self::class, 'isValid']))
        );
        usort($versions, static fn (self $a, self $b): int => $a->compare($b));

        return $versions === [] ? null : end($versions);
    }

    /**
     * @param string $kind patch, minor or major (the php-version-* label without its prefix)
     */
    public function bump(string $kind): self
    {
        return match ($kind) {
            'major' => new self($this->major + 1, 0, 0),
            'minor' => new self($this->major, $this->minor + 1, 0),
            'patch' => new self($this->major, $this->minor, $this->patch + 1),
            default => throw new ReleaseError("Unknown version bump '{$kind}', expected patch, minor or major"),
        };
    }

    public function compare(self $other): int
    {
        return [$this->major, $this->minor, $this->patch] <=> [$other->major, $other->minor, $other->patch];
    }

    public function equals(self $other): bool
    {
        return $this->compare($other) === 0;
    }

    public function __toString(): string
    {
        return "{$this->major}.{$this->minor}.{$this->patch}";
    }
}
