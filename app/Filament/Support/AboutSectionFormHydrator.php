<?php

namespace App\Filament\Support;

use App\Models\AboutSection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class AboutSectionFormHydrator
{
    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function beforeFill(array $data): array
    {
        $data = self::hydrateVirtualUploadFields(
            $data,
            'hero_image_path',
            'hero_image_file',
            'hero_external',
        );

        return self::hydrateVirtualUploadFields(
            $data,
            'footer_icon_path',
            'footer_icon_file',
            'footer_external',
        );
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function beforeSave(array $data, ?AboutSection $record): array
    {
        $data = self::persistUploadField(
            $data,
            $record,
            'hero_image_path',
            'hero_image_file',
            'hero_external',
            'about-section',
        );

        $data = self::persistUploadField(
            $data,
            $record,
            'footer_icon_path',
            'footer_icon_file',
            'footer_external',
            'about-section-icons',
        );

        return Arr::except($data, [
            'hero_image_file',
            'hero_external',
            'footer_icon_file',
            'footer_external',
        ]);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private static function hydrateVirtualUploadFields(
        array $data,
        string $pathKey,
        string $fileKey,
        string $externalKey,
    ): array {
        $path = trim((string) ($data[$pathKey] ?? ''));

        if ($path === '') {
            $data[$fileKey] = null;
            $data[$externalKey] = null;

            return $data;
        }

        if (
            Str::startsWith($path, ['http://', 'https://'])
            || Str::startsWith(ltrim($path, '/'), 'images/')
        ) {
            $data[$externalKey] = $path;
            $data[$fileKey] = null;
        } else {
            $data[$fileKey] = $path;
            $data[$externalKey] = null;
        }

        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private static function persistUploadField(
        array $data,
        ?AboutSection $record,
        string $pathKey,
        string $fileKey,
        string $externalKey,
        string $uploadDirectory,
    ): array {
        $external = trim((string) ($data[$externalKey] ?? ''));
        $file = $data[$fileKey] ?? null;

        if ($external !== '') {
            $data[$pathKey] = $external;
        } elseif ($file instanceof UploadedFile) {
            $data[$pathKey] = $file->store($uploadDirectory, 'webroot');
        } elseif (is_string($file) && $file !== '') {
            $data[$pathKey] = $file;
        } elseif (is_array($file) && $file !== []) {
            $data[$pathKey] = (string) reset($file);
        } elseif ($record !== null) {
            $data[$pathKey] = $record->getAttribute($pathKey);
        }

        return $data;
    }
}
