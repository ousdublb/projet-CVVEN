<?php
// Simple favicon generator using GD, creates PNGs at 16,32,48,64 and an ICO embedding 64x64 PNG
$sizes = [16, 32, 48, 64];
$bg = [221, 72, 20]; // #DD4814
$fg = [255,255,255];

function draw_hotel($img, $w, $h, $fg) {
    // Draw a simple hotel: base rectangle, roof, door and windows
    $white = imagecolorallocate($img, $fg[0], $fg[1], $fg[2]);
    // building
    $bw = (int)($w * 0.7);
    $bh = (int)($h * 0.55);
    $bx = (int)(($w - $bw) / 2);
    $by = (int)($h * 0.3);
    imagefilledrectangle($img, $bx, $by, $bx+$bw, $by+$bh, $white);
    // roof
    $roofH = max(2, (int)($h*0.12));
    imagefilledpolygon($img, [$bx, $by, $bx+$bw, $by, $bx+($bw/2), $by-$roofH], 3, $white);
    // windows (3 columns, 2 rows)
    $cols = 3; $rows = 2;
    $wx = $bw / ($cols+1);
    $wy = $bh / ($rows+1);
    $sizeW = max(1, (int)($wx*0.4));
    $sizeH = max(1, (int)($wy*0.35));
    for ($r=1;$r<=$rows;$r++) {
        for ($c=1;$c<=$cols;$c++) {
            $cx = (int)($bx + $c * $wx - $sizeW/2);
            $cy = (int)($by + $r * $wy - $sizeH/2);
            imagefilledrectangle($img, $cx, $cy, $cx+$sizeW, $cy+$sizeH, imagecolorallocate($img, 221,72,20));
        }
    }
    // door
    $dw = max(1, (int)($bw*0.18));
    $dh = max(1, (int)($bh*0.32));
    $dx = (int)($bx + ($bw-$dw)/2);
    $dy = (int)($by + $bh - $dh);
    imagefilledrectangle($img, $dx, $dy, $dx+$dw, $dy+$dh, imagecolorallocate($img, 0,0,0));
}

foreach ($sizes as $size) {
    $img = imagecreatetruecolor($size, $size);
    imagesavealpha($img, true);
    $trans = imagecolorallocatealpha($img, 0, 0, 0, 127);
    imagefill($img, 0, 0, $trans);
    // rounded background
    $bgcol = imagecolorallocate($img, $bg[0], $bg[1], $bg[2]);
    $radius = (int)($size * 0.12);
    // draw rounded rect via filled rectangles + corners
    imagefilledrectangle($img, $radius, 0, $size-$radius-1, $size-1, $bgcol);
    imagefilledrectangle($img, 0, $radius, $size-1, $size-$radius-1, $bgcol);
    // corners
    imagefilledellipse($img, $radius, $radius, $radius*2, $radius*2, $bgcol);
    imagefilledellipse($img, $size-$radius-1, $radius, $radius*2, $radius*2, $bgcol);
    imagefilledellipse($img, $radius, $size-$radius-1, $radius*2, $radius*2, $bgcol);
    imagefilledellipse($img, $size-$radius-1, $size-$radius-1, $radius*2, $radius*2, $bgcol);

    // draw hotel in white
    draw_hotel($img, $size, $size, $fg);

    $png_path = __DIR__ . '/../favicon-' . $size . '.png';
    imagepng($img, $png_path);
    imagedestroy($img);

    // copy into public
    copy($png_path, __DIR__ . '/../public/favicon-' . $size . '.png');
}

// create favicon.png (64x64) and copy
copy(__DIR__ . '/../favicon-64.png', __DIR__ . '/../favicon.png');
copy(__DIR__ . '/../favicon-64.png', __DIR__ . '/../public/favicon.png');

// Build a simple .ico that embeds the 64x64 PNG (many browsers accept PNG-in-ICO)
$pngData = file_get_contents(__DIR__ . '/../favicon-64.png');
$pngSize = strlen($pngData);

$ico = "";
// header: reserved(2), type(2=1), count(2)
$ico .= pack('vvv', 0, 1, 1);
// directory entry: width, height, color count, reserved, planes, bitcount, bytes, offset
$widthByte = 64 === 256 ? 0 : 64; // but fits in 1 byte
$ico .= pack('CCCCvvVV', $widthByte, 64, 0, 0, 0, 32, $pngSize, 6 + 16);
// append png data
$ico .= $pngData;

file_put_contents(__DIR__ . '/../favicon.ico', $ico);
copy(__DIR__ . '/../favicon.ico', __DIR__ . '/../public/favicon.ico');

echo "Favicons generated: favicon-{16,32,48,64}.png, favicon.png, favicon.ico\n";
