<?php
/**
 * Freeform for Craft
 *
 * @package       Solspace:Freeform
 * @author        Solspace, Inc.
 * @copyright     Copyright (c) 2008-2016, Solspace, Inc.
 * @link          https://solspace.com/craft/freeform
 * @license       https://solspace.com/software/license-agreement
 */

namespace Solspace\Commons\Helpers;

class ColorHelper
{
    /**
     * Generates a random HEX color code
     *
     * @return string
     */
    public static function randomColor(): string
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    /**
     * Determines if the contrasting color to be used based on a HEX color code
     *
     * @param string $hexColor
     *
     * @return string
     */
    public static function getContrastYIQ($hexColor): string
    {
        $hexColor = str_replace('#', '', $hexColor);

        $r   = hexdec(substr($hexColor, 0, 2));
        $g   = hexdec(substr($hexColor, 2, 2));
        $b   = hexdec(substr($hexColor, 4, 2));
        $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;

        return ($yiq >= 128) ? 'black' : 'white';
    }

    /**
     * Generates an RGB color based on $id int or hex string
     *
     * @param int|string $id
     *
     * @return array
     */
    public static function getRGBColor($id): array
    {
        if (strpos($id, '#') === 0) {
            $hash = substr($id, 1, 6);
        } else {
            $hash = md5($id); // modify 'color' to get a different palette
        }

        return [
            hexdec(substr($hash, 0, 2)), // r
            hexdec(substr($hash, 2, 2)), // g
            hexdec(substr($hash, 4, 2)), // b
        ];
    }
}
