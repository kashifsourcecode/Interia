<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Builds correct URLs for CMS media stored under public/ or legacy storage/app/public.
 */
final class MediaUrl
{
    /**
     * Directories we store uploads in (relative to public/, no leading slash).
     *
     * @var list<string>
     */
    private const WEBROOT_UPLOAD_DIRS = [
        'service-carousel',
        'service-icons',
        'gallery-mosaic',
        'ai-adoption',
        'ai-adoption-icons',
        'why-section',
        'why-section-icons',
        'offer-section-icons',
        'pricing-addon-icons',
        'about-section',
        'about-section-icons',
        'contact-section-icons',
    ];

    public static function fromPath(string $path): string
    {
        if ($path === '') {
            return '';
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return self::encodeHttpUrl($path);
        }

        $normalized = str_replace('\\', '/', ltrim($path, '/'));

        if (Str::startsWith($normalized, 'images/')) {
            return self::finalizeUrl(asset($normalized));
        }

        if (file_exists(public_path($normalized))) {
            return self::finalizeUrl(asset($normalized));
        }

        if (Storage::disk('public')->exists($normalized)) {
            return self::finalizeUrl(Storage::disk('public')->url($normalized));
        }

        foreach (self::WEBROOT_UPLOAD_DIRS as $dir) {
            if (Str::startsWith($normalized, $dir.'/')) {
                return self::finalizeUrl(asset($normalized));
            }
        }

        return self::finalizeUrl(Storage::disk('public')->url($normalized));
    }

    /**
     * Encode spaces/special chars in the path so FILTER_VALIDATE_URL passes (Filament ImageColumn).
     */
    private static function finalizeUrl(string $url): string
    {
        if ($url === '') {
            return '';
        }

        if (! Str::startsWith($url, ['http://', 'https://'])) {
            $path = parse_url($url, PHP_URL_PATH);
            if (is_string($path) && str_starts_with($path, '/')) {
                $url = url($path);
            } else {
                $url = url('/'.ltrim($url, '/'));
            }
        }

        return self::encodeHttpUrl($url);
    }

    /**
     * Spaces in URLs break PHP's FILTER_VALIDATE_URL; Filament then treats the string as a disk path and prepends the base URL again (doubled domain).
     */
    public static function encodeHttpUrl(string $url): string
    {
        if ($url === '' || ! Str::startsWith($url, ['http://', 'https://'])) {
            return $url;
        }

        $parsed = parse_url($url);
        if ($parsed === false || ! isset($parsed['scheme'], $parsed['host'])) {
            return $url;
        }

        $path = $parsed['path'] ?? '';
        $segments = explode('/', $path);
        $encodedSegments = array_map(function (string $segment): string {
            if ($segment === '') {
                return '';
            }

            return rawurlencode(rawurldecode($segment));
        }, $segments);
        $encodedPath = implode('/', $encodedSegments);

        return $parsed['scheme'].'://'.$parsed['host']
            .(isset($parsed['port']) ? ':'.$parsed['port'] : '')
            .$encodedPath
            .(isset($parsed['query']) ? '?'.$parsed['query'] : '')
            .(isset($parsed['fragment']) ? '#'.$parsed['fragment'] : '');
    }
}
