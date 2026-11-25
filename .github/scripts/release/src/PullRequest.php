<?php

declare(strict_types=1);

namespace Pipedrive\Release;

/**
 * Decides whether a release PR (GitHub REST "pulls/{n}" JSON) can be released now.
 */
final class PullRequest
{
    public const LABEL_PREFIX = 'php-version-';

    public const RELEASE = 'release';
    public const CONFLICT = 'conflict';

    /**
     * @param array<string, mixed> $pr
     * @return array<string, string> step outputs: number, head_sha, head_ref, bump, action
     */
    public static function check(array $pr, string $baseBranch): array
    {
        $number = (string) ($pr['number'] ?? '?');
        $state = (string) ($pr['state'] ?? '');
        $base = (string) ($pr['base']['ref'] ?? '');
        if ($state !== 'open' || $base !== $baseBranch) {
            throw new ReleaseError("PR #{$number} is {$state} with base {$base}, expected an open PR to {$baseBranch}.");
        }

        $bumps = self::bumpLabels($pr);
        if (count($bumps) !== 1) {
            throw new ReleaseError(
                "PR #{$number} needs exactly one of the labels " . self::LABEL_PREFIX . 'patch|minor|major, found: '
                . ($bumps === [] ? 'none' : implode(', ', $bumps))
            );
        }

        return [
            'number' => $number,
            'head_sha' => (string) ($pr['head']['sha'] ?? ''),
            'head_ref' => (string) ($pr['head']['ref'] ?? ''),
            'bump' => $bumps[0],
            'action' => self::action($pr, $number),
        ];
    }

    /**
     * @param array<string, mixed> $pr
     * @return string[] patch, minor or major for each php-version-* label
     */
    private static function bumpLabels(array $pr): array
    {
        $bumps = [];
        foreach ($pr['labels'] ?? [] as $label) {
            $name = (string) ($label['name'] ?? '');
            if (str_starts_with($name, self::LABEL_PREFIX)) {
                $bumps[] = substr($name, strlen(self::LABEL_PREFIX));
            }
        }
        foreach ($bumps as $bump) {
            if (!in_array($bump, ['patch', 'minor', 'major'], true)) {
                throw new ReleaseError("Unknown label " . self::LABEL_PREFIX . "{$bump}");
            }
        }

        return $bumps;
    }

    /** @param array<string, mixed> $pr */
    private static function action(array $pr, string $number): string
    {
        $mergeable = $pr['mergeable'] ?? null;
        if ($mergeable === false || ($pr['mergeable_state'] ?? null) === 'dirty') {
            return self::CONFLICT;
        }
        if ($mergeable === true) {
            return self::RELEASE;
        }

        throw new ReleaseError("Could not determine mergeability of PR #{$number}, re-run the workflow later.");
    }
}
