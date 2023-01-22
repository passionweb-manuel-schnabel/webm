.. include:: ../Includes.txt


.. _admin-manual:

Administration Manual
=====================

Target group: **Administrators**

.. _admin-installation:

Requirements
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This extension uses the FFmpeg solution and the PHP-FFmpeg library. You need to prepare your server for the usage and must install the necessary packages. A complete guide and further information can be found here:

- Source: `FFmpeg <https://ffmpeg.org/>`_

- Source: `PHP-FFmpeg <https://github.com/PHP-FFMpeg/PHP-FFMpeg>`_

Installation
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Add via composer.json:

.. code-block:: javascript

  composer require "passionweb/webm"

.. _admin-configuration:

Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Extension manager configuration
-------------

You can set parameters for the conversion in the extension configuration.

.. code-block:: none

  # cat=basic; type=boolean; label=Convert video on save action in backend (default=convert with task/Symfony command)
  convertOnSave = 0

Every video will be added to the queue and will be processed with the corresponding task/Symfony command by default. If you want to convert the video with saving it you can enable that with this option. The video will not be added to the queue.

.. code-block:: none

  # cat=basic; type=string; label=Supported mime types (comma separated)
  mimeTypes = video/mp4,video/ogg,video/x-m4v,application/ogg

You can decide the mime types which will be considered by the convertion.

.. code-block:: none

  # cat=basic; type=int+; label=Max file size of original video to convert (videos which are larger wil be ignored)
  maxVideoFileSize = 0

You can set a maximum file size of the original video to convert to avoid a possible server overload. If this value is greater than 0 videos which are larger than the entered value wil be ignored during convertion.

.. code-block:: none

  # cat=basic; type=int+; label=Save queue items in this folder/storage
  storagePid = 0

You can set a specific folder/storage where queue items will be stored by entering the corresponding page uid.

Web server configuration
^^^^^^^^^^^^^^^^^^^^^^^^

This extension uses the FFmpeg solution and the PHP-FFmpeg library. You need to prepare your server for the usage and must install the necessary packages. A complete guide and further information can be found here:

- Source: `FFmpeg <https://ffmpeg.org/download.html>`_

- Source: `PHP-FFmpeg <https://github.com/PHP-FFMpeg/PHP-FFMpeg>`_
