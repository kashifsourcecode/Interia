<?php

namespace App\Filament\Support;

use App\Models\AiAdoptionSection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

final class AiAdoptionDashboardFormHydrator
{
    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function beforeFill(array $data): array
    {
        $path = trim((string) ($data['dashboard_image_path'] ?? ''));

        if ($path === '') {
            $data['dashboard_image_file'] = null;
            $data['dashboard_external'] = null;

            return $data;
        }

        if (
            Str::startsWith($path, ['http://', 'https://'])
            || Str::startsWith(ltrim($path, '/'), 'images/')
        ) {
            $data['dashboard_external'] = $path;
            $data['dashboard_image_file'] = null;
        } else {
            $data['dashboard_image_file'] = $path;
            $data['dashboard_external'] = null;
        }

        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public static function beforeSave(array $data, ?AiAdoptionSection $record): array
    {
        $external = trim((string) ($data['dashboard_external'] ?? ''));
        $file = $data['dashboard_image_file'] ?? null;

        if ($external !== '') {
            $data['dashboard_image_path'] = $external;
        } elseif ($file instanceof UploadedFile) {
            $data['dashboard_image_path'] = $file->store('ai-adoption', 'webroot');
        } elseif (is_string($file) && $file !== '') {
            $data['dashboard_image_path'] = $file;
        } elseif (is_array($file) && $file !== []) {
            $data['dashboard_image_path'] = (string) reset($file);
        } elseif ($record !== null) {
            $data['dashboard_image_path'] = $record->dashboard_image_path;
        }

        return Arr::except($data, ['dashboard_image_file', 'dashboard_external']);
    }
}
