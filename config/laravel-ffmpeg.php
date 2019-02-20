<?php

return [
    'default_disk' => 'local',

    'ffmpeg.binaries' => env("FFMPEG", '/usr/bin/ffmpeg'),
    'ffmpeg.threads'  => 12,

    'ffprobe.binaries' => env('FFPROBE', '/usr/bin/ffprobe'),

    'timeout' => 3600,
];
