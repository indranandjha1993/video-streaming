<?php

require 'vendor/autoload.php';

use Monolog\Handler\StreamHandler;
use Streaming\Representation;
use Monolog\Logger;

$config = [
    'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
    'ffprobe.binaries' => '/usr/bin/ffprobe',
    'timeout'          => 3600, // The timeout for the underlying process
    'ffmpeg.threads'   => 12,   // The number of threads that FFmpeg should use
];

$log = new Logger('FFmpeg_Streaming');
$log->pushHandler(new StreamHandler('/var/log/ffmpeg-streaming.log')); // path to log file
    
$ffmpeg = Streaming\FFMpeg::create($config, $log);

// Open video file
$video = $ffmpeg->open('./video/big_buck_bunny_720p_1mb.mp4');


# Adaptive bitrate streaming
$video->dash()
    ->x264() // Format of the video. Alternatives: hevc() and vp9()
    ->autoGenerateRepresentations() // Auto generate representations
    ->save(); // It can be passed a path to the method or it can be null



# Generate representations manually:
// $r_144p  = (new Representation)->setKiloBitrate(95)->setResize(256, 144);
// $r_240p  = (new Representation)->setKiloBitrate(150)->setResize(426, 240);
// $r_360p  = (new Representation)->setKiloBitrate(276)->setResize(640, 360);
// $r_480p  = (new Representation)->setKiloBitrate(750)->setResize(854, 480);
// $r_720p  = (new Representation)->setKiloBitrate(2048)->setResize(1280, 720);
// $r_1080p = (new Representation)->setKiloBitrate(4096)->setResize(1920, 1080);
// $r_2k    = (new Representation)->setKiloBitrate(6144)->setResize(2560, 1440);
// $r_4k    = (new Representation)->setKiloBitrate(17408)->setResize(3840, 2160);


// $video->dash()
//     ->x264()
//     ->addRepresentations([$r_144p, $r_240p, $r_360p, $r_480p, $r_720p, $r_1080p, $r_2k, $r_4k])
//     ->save('./video/media/dash-stream.mpd');


// Encryption(DRM)
//A path you want to save a random key to your local machine
$save_to = './key/key';

//An URL (or a path) to access the key on your website
$url = 'http://localhost:8001/video-streaming/key/key';

$video->hls()
    ->encryption($save_to, $url)
    ->x264()
    ->autoGenerateRepresentations([1080, 480, 240])
    ->save('./video/media/hls-stream.m3u8');

print_r($video);