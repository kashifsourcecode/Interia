<?php

namespace App\Filament\Support;

use App\Models\HeroSection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class HeroSectionFormHydrator
{
    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function beforeFill(array $data): array
    {
        $data = self::hydrateVirtualUploadFields($data, 'background_image_path', 'background_image_file', 'background_image_external');
        $data = self::hydrateVirtualUploadFields($data, 'primary_cta_icon_path', 'primary_cta_icon_file', 'primary_cta_icon_external');
        $data = self::hydrateVirtualUploadFields($data, 'secondary_cta_icon_path', 'secondary_cta_icon_file', 'secondary_cta_icon_external');

        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function beforeSave(array $data, ?HeroSection $record): array
    {
        $data = self::persistUploadField($data, $record, 'background_image_path', 'background_image_file', 'background_image_external', 'hero-section');
        $data = self::persistUploadField($data, $record, 'primary_cta_icon_path', 'primary_cta_icon_file', 'primary_cta_icon_external', 'hero-section-cta-icons');
        $data = self::persistUploadField($data, $record, 'secondary_cta_icon_path', 'secondary_cta_icon_file', 'secondary_cta_icon_external', 'hero-section-cta-icons');

        return Arr::except($data, [
            'background_image_file',
            'background_image_external',
            'primary_cta_icon_file',
            'primary_cta_icon_external',
            'secondary_cta_icon_file',
            'secondary_cta_icon_external',
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
        ?HeroSection $record,
        string $pathKey,
        string $fileKey,
        string $externalKey,
        string $directory,
    ): array {
        $external = trim((string) ($data[$externalKey] ?? ''));
        $file = $data[$fileKey] ?? null;

        if ($external !== '') {
            $data[$pathKey] = $external;
        } elseif ($file instanceof UploadedFile) {
            $data[$pathKey] = $file->store($directory, 'webroot');
        } elseif (is_string($file) && $file !== '') {
            $data[$pathKey] = $file;
        } elseif (is_array($file) && $file !== []) {
            $data[$pathKey] = (string) reset($file);
        } elseif ($record !== null) {
            $data[$pathKey] = $record->{$pathKey};
        }

        return $data;
    }
}
