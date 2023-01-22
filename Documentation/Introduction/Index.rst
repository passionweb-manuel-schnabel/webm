.. include:: ../Includes.txt


.. _introduction:

Introduction
============


.. _what-it-does:

What does it do?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Creates a _WebM_ file for every configured (and supported) video format. Either via Symfony command or hook (can be configured)

  original.mp4 --> original.webm

What is WebM?
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

  WebM is an audiovisual media file format. It is primarily intended to offer a royalty-free alternative to use in the HTML5 video and the HTML5 audio elements. It has a sister project, WebP,
  for images. The development of the format is sponsored by Google, and the corresponding software is distributed under a BSD license. The WebM container is based on a profile of Matroska. WebM
  initially supported VP8 video and Vorbis audio streams. In 2013, it was updated to accommodate VP9 video and Opus audio. It also supports the new AV1 codec.

  - Source: `WEbM <https://en.wikipedia.org/wiki/WebM>`_

Drawbacks
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Note that this extension produces an additional load on your server (each supported video will be processed) and possibly creates a lot of
additional files that consume disk space. Size varies depending on your configuration.

Used solutions and libraries
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This extension uses the FFmpeg solution and the PHP-FFmpeg library. You need to prepare your server for the usage and must install the necessary packages. A complete guide and further information can be found here:

- Source: `FFmpeg <https://ffmpeg.org/>`_

- Source: `PHP-FFmpeg <https://github.com/PHP-FFMpeg/PHP-FFMpeg>`_

Browser Support
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

- Detailed information to browser support can be found here: `WebM video format <https://caniuse.com/webm>`_


