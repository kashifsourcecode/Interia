<?php

namespace App\Filament\Support;

use App\Models\WhySection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class WhySectionHeroFormHydrator
{
    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function beforeFill(array $data): array
    {
        $path = trim((string) ($data['hero_image_path'] ?? ''));

        if ($path === '') {
            $data['hero_image_file'] = null;
            $data['hero_external'] = null;

            return $data;
        }

        if (
            Str::startsWith($path, ['http://', 'https://'])
            || Str::startsWith(ltrim($path, '/'), 'images/')
        ) {
            $data['hero_external'] = $path;
            $data['hero_image_file'] = null;
        } else {
            $data['hero_image_file'] = $path;
            $data['hero_external'] = null;
        }

        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function beforeSave(array $data, ?WhySection $record): array
    {
        $external = trim((string) ($data['hero_external'] ?? ''));
        $file = $data['hero_image_file'] ?? null;

        if ($external !== '') {
            $data['hero_image_path'] = $external;
        } elseif ($file instanceof UploadedFile) {
            $data['hero_image_path'] = $file->store('why-section', 'webroot');
        } elseif (is_string($file) && $file !== '') {
            $data['hero_image_path'] = $file;
        } elseif (is_array($file) && $file !== []) {
            $data['hero_image_path'] = (string) reset($file);
        } elseif ($record !== null) {
            $data['hero_image_path'] = $record->hero_image_path;
        }

        return Arr::except($data, ['hero_image_file', 'hero_external']);
    }
}
