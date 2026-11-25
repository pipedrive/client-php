<?php

declare(strict_types=1);

namespace Pipedrive\Release;

/**
 * The SDK user agent, "Pipedrive-SDK-PHP-<major>.x", in Configuration.php and in the
 * sdk-manager template kits/php/templates/Configuration.mustache.
 */
final class UserAgent
{
    public static function for(int $major): string
    {
        return "Pipedrive-SDK-PHP-{$major}.x";
    }

    /**
     * Replaces the <from> user agent with the <to> one. Content that already has the
     * <to> user agent is returned unchanged, so re-running is safe.
     */
    public static function bump(string $content, int $from, int $to): string
    {
        $old = self::for($from);
        $new = self::for($to);
        if (str_contains($content, $old)) {
            return str_replace($old, $new, $content);
        }
        if (str_contains($content, $new)) {
            return $content;
        }

        throw new ReleaseError("contains neither {$old} nor {$new}");
    }
}
