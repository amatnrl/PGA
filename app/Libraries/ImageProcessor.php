<?php

namespace App\Libraries;

use Config\Services;

class ImageProcessor
{
    /** Width in px for each derivative size. */
    private const SIZES = [
        'thumb'  => 300,
        'medium' => 800,
        'large'  => 1600,
    ];

    private const WEBP_QUALITY = 85;

    /**
     * Resize the source image into thumb/medium/large variants, convert each to WEBP,
     * and store them in $destDir. Returns the relative paths (from FCPATH) of each variant.
     *
     * @return array{thumb: string, medium: string, large: string, original: string}
     */
    public function process(string $sourcePath, string $destDir, string $baseName): array
    {
        if (! is_dir($destDir)) {
            mkdir($destDir, 0755, true);
        }

        $originalName = $baseName . '.' . $this->detectExtension($sourcePath);
        $originalDest = rtrim($destDir, '/') . '/' . $originalName;
        copy($sourcePath, $originalDest);

        $result = ['original' => $this->toRelativePath($originalDest)];

        foreach (self::SIZES as $label => $width) {
            $webpName = $baseName . '-' . $label . '.webp';
            $webpDest = rtrim($destDir, '/') . '/' . $webpName;

            Services::image('gd')
                ->withFile($sourcePath)
                ->resize($width, $width, true, 'width')
                ->convert(IMAGETYPE_WEBP)
                ->save($webpDest, self::WEBP_QUALITY);

            $result[$label] = $this->toRelativePath($webpDest);
        }

        return $result;
    }

    /**
     * Convert the source image to WEBP at its original resolution (no resizing/downscaling).
     * Returns the relative path (from FCPATH) of the converted file.
     */
    public function toWebpFullRes(string $sourcePath, string $destDir, string $baseName): string
    {
        if (! is_dir($destDir)) {
            mkdir($destDir, 0755, true);
        }

        $webpDest = rtrim($destDir, '/') . '/' . $baseName . '.webp';

        Services::image('gd')
            ->withFile($sourcePath)
            ->convert(IMAGETYPE_WEBP)
            ->save($webpDest, self::WEBP_QUALITY);

        return $this->toRelativePath($webpDest);
    }

    public function delete(array $paths): void
    {
        foreach ($paths as $path) {
            $full = FCPATH . ltrim($path, '/');
            if (is_file($full)) {
                unlink($full);
            }
        }
    }

    private function toRelativePath(string $absolutePath): string
    {
        return str_replace(FCPATH, '', $absolutePath);
    }

    private function detectExtension(string $path): string
    {
        $type = @exif_imagetype($path);

        return match ($type) {
            IMAGETYPE_JPEG => 'jpg',
            IMAGETYPE_PNG  => 'png',
            IMAGETYPE_WEBP => 'webp',
            IMAGETYPE_GIF  => 'gif',
            default        => pathinfo($path, PATHINFO_EXTENSION) ?: 'jpg',
        };
    }
}
