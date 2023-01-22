# TYPO3 Extension `WebM`

Creates a _WebM_ file for every configured (and supported) video format. Either via Symfony command or hook (can be configured).

    original.mp4 --> original.webm

## What is WebM?

WebM is an audiovisual media file format. It is primarily intended to offer a royalty-free alternative to use in the HTML5 video and the HTML5 audio elements. It has a sister project, WebP,
for images. The development of the format is sponsored by Google, and the corresponding software is distributed under a BSD license. The WebM container is based on a profile of Matroska. WebM
initially supported VP8 video and Vorbis audio streams. In 2013, it was updated to accommodate VP9 video and Opus audio. It also supports the new AV1 codec.

Source: [WebM](https://en.wikipedia.org/wiki/WebM "WebM")

## Installation

Add via composer:

    composer require "passionweb/webm"

* Install the extension via composer
* Flush TYPO3 and PHP Cache

## Requirements

This extension uses the FFmpeg solution and the PHP-FFmpeg library. You need to prepare your server for the usage and must install the necessary packages. A complete guide and further information can be found here:

Source: [FFmpeg](https://ffmpeg.org/ "FFmpeg")

Source: [PHP-FFmpeg](https://github.com/PHP-FFMpeg/PHP-FFMpeg "PHP-FFmpeg")

## FFMpeg support with DDEV

You can extend the `config.yaml` in your `.ddev` folder and add `webimage_extra_packages: [ffmpeg]` to install the FFMpeg package

## Extension settings

You can set parameters for the conversion handling in the extension configuration.

### `convertOnSave`

    # cat=basic; type=boolean; label=Convert video on save action in backend (default=convert with task/Symfony command)
    convertOnSave = 0

Every video will be added to the queue and will be processed with the corresponding task/Symfony command by default. If you want to convert the video with saving it you can enable that with this option. The video will not be added to the queue.

### `mimeTypes`

    # cat=basic; type=string; label=Supported mime types (comma separated)
    mimeTypes = video/mp4,video/ogg,video/x-m4v,application/ogg

You can decide the mime types which will be considered by the convertion.

### `maxVideoFileSize`

    # cat=basic; type=int+; label=Max file size of original video to convert (videos which are larger wil be ignored)
    maxVideoFileSize = 0

You can set a maximum file size of the original video to convert to avoid a possible server overload. If this value is greater than 0 videos which are larger than the entered value wil be ignored during convertion.

### `storagePid`

    # cat=basic; type=int+; label=Save queue items in this folder/storage
    storagePid = 0

You can set a specific folder/storage where queue items will be stored by entering the corresponding page uid.

## Troubleshooting and logging

If something does not work as expected take a look at the log file.
Every problem is logged to the TYPO3 log (normally found in `var/log/typo3_*.log`)

## Drawbacks to keep in mind

Note that this extension produces an additional load on your server (each supported video will be processed) and possibly creates a lot of
additional files that consume disk space. Size varies depending on your configuration.
