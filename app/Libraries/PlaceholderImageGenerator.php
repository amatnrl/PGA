<?php

namespace App\Libraries;

/**
 * Generates simple branded placeholder images (solid background + centered label)
 * for seeding demo data, since no licensed product photography is available.
 * Output is a temp PNG file path meant to be fed into ImageProcessor::process().
 */
class PlaceholderImageGenerator
{
    private const COLORS = [
        [214, 0, 0],   // primary red
        [160, 0, 0],   // dark red
        [75, 75, 75],  // accent gray
        [26, 26, 26],  // accent black
    ];

    public function generate(string $label, int $width = 800, int $height = 800): string
    {
        $image = imagecreatetruecolor($width, $height);

        [$r, $g, $b] = self::COLORS[array_rand(self::COLORS)];
        $bg = imagecolorallocate($image, $r, $g, $b);
        imagefill($image, 0, 0, $bg);

        $white = imagecolorallocate($image, 255, 255, 255);
        $this->drawWrappedText($image, $label, $width, $height, $white);

        $tempPath = sys_get_temp_dir() . '/' . bin2hex(random_bytes(8)) . '.png';
        imagepng($image, $tempPath);
        imagedestroy($image);

        return $tempPath;
    }

    private function drawWrappedText($image, string $label, int $width, int $height, $color): void
    {
        $font     = 5;
        $charW    = imagefontwidth($font);
        $charH    = imagefontheight($font);
        $maxChars = (int) floor(($width * 0.8) / $charW);

        $words = explode(' ', $label);
        $lines = [];
        $current = '';

        foreach ($words as $word) {
            $candidate = trim($current . ' ' . $word);
            if (strlen($candidate) > $maxChars && $current !== '') {
                $lines[]  = $current;
                $current  = $word;
            } else {
                $current = $candidate;
            }
        }
        if ($current !== '') {
            $lines[] = $current;
        }

        $totalHeight = count($lines) * ($charH + 4);
        $startY      = (int) (($height - $totalHeight) / 2);

        foreach ($lines as $i => $line) {
            $textWidth = strlen($line) * $charW;
            $x         = (int) (($width - $textWidth) / 2);
            $y         = $startY + $i * ($charH + 4);
            imagestring($image, $font, $x, $y, $line, $color);
        }
    }
}
