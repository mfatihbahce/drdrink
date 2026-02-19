<?php
/**
 * Generates a two-tone notification WAV file.
 * Run: php generate_notification_sound.php
 */
$sampleRate = 44100;
$amplitude = 0.3 * 32768; // Slightly louder for better audibility

$samples = [];
$addTone = function($freq, $dur) use (&$samples, $sampleRate, $amplitude) {
    $w = 2 * M_PI * $freq / $sampleRate;
    $count = (int)($sampleRate * $dur);
    for ($n = 0; $n < $count; $n++) {
        $samples[] = (int)($amplitude * sin($n * $w));
    }
};
$addPause = function($dur) use (&$samples, $sampleRate) {
    $count = (int)($sampleRate * $dur);
    for ($n = 0; $n < $count; $n++) $samples[] = 0;
};

// Professional triple chime: 523Hz (C5) - 659Hz (E5) - 784Hz (G5) - attention-grabbing
$addTone(523, 0.12);
$addPause(0.05);
$addTone(659, 0.12);
$addPause(0.05);
$addTone(784, 0.2);

$bps = 16;
$Bps = $bps / 8;
$dataSize = count($samples) * 2; // 16-bit = 2 bytes per sample
$fileSize = 36 + $dataSize;

$dir = __DIR__ . '/public/sounds';
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

$header = pack('V', 0x46464952)   // RIFF
    . pack('V', $fileSize)
    . pack('V', 0x45564157)       // WAVE
    . pack('V', 0x20746d66)       // "fmt "
    . pack('V', 16)
    . pack('v', 1)                // PCM
    . pack('v', 1)                // mono
    . pack('V', $sampleRate)
    . pack('V', $Bps * $sampleRate)
    . pack('v', $Bps)
    . pack('v', $bps)
    . pack('V', 0x61746164)       // "data"
    . pack('V', $dataSize);

$data = '';
foreach ($samples as $s) {
    $data .= pack('v', max(-32768, min(32767, $s)));
}

$wav = $header . $data;
file_put_contents($dir . '/new-order.wav', $wav);
echo "Created: $dir/new-order.wav\n";

// Silent WAV for audio unlock (browser autoplay policy)
$silentSamples = array_fill(0, 4410, 0); // 0.1 sec
$silentDataSize = count($silentSamples) * 2;
$silentFileSize = 36 + $silentDataSize;
$silentHeader = pack('V', 0x46464952) . pack('V', $silentFileSize) . pack('V', 0x45564157)
    . pack('V', 0x20746d66) . pack('V', 16) . pack('v', 1) . pack('v', 1)
    . pack('V', $sampleRate) . pack('V', $Bps * $sampleRate) . pack('v', $Bps) . pack('v', $bps)
    . pack('V', 0x61746164) . pack('V', $silentDataSize);
$silentData = str_repeat(pack('v', 0), count($silentSamples));
file_put_contents($dir . '/silent.wav', $silentHeader . $silentData);
echo "Created: $dir/silent.wav\n";
