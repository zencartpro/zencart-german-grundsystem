<?php
// -----
// Part of the Log Manager plugin, created by lat9 (lat9@vinosdefrutastropicales.com)
// Copyright (c) 2017-2023, Vinos de Frutas Tropicales.
//
// -----
// This message, issued by the plugin's initialization script, is issued if one or more .log file has been removed:
//
// %1$u ... The number of files removed
// %2$s ... The file prefix (for site-specific files) and extension for the files removed.
// %3$s ... The directory from which the files were removed.
// %4$s ... The date/time that was used during the check.
//
define('LOG_MANAGER_FILES_MESSAGE_FORMAT', 'Es wurden %1$u %2$s Logfiles aus dem Logverzeichnis entfernt, die älter waren als %4$s.');