<?php

namespace HugoSoltys\FitzBundle\Helper;

class FileHelper
{
    public static function contains($filename, $search, $caseSensitive = false)
    {
        if (!\file_exists($filename)) {
            throw new \Exception("The %s file does not exist.", $filename);
        }

        if ($caseSensitive) {
            return \strpos(\file_get_contents($filename), $search) !== false;
        }

        return \stripos(\file_get_contents($filename), $search) !== false;
    }

    public static function append($filename, $content)
    {
        \file_put_contents($filename, $content, FILE_APPEND | LOCK_EX);
    }

    public static function remove($filename, $toRemove)
    {
        if (!\file_exists($filename)) {
            throw new \Exception(\sprintf("The %s file does not exist.", $filename));
        }

        $content = \file_get_contents($filename);
        $content = \str_replace($toRemove, '', $content);

        \file_put_contents($filename, $content);
    }

    public static function copy($source, $dest)
    {
        if (!\file_exists($source)) {
            throw new \Exception(\sprintf("The %s file does not exist.", $source));
        }

        \copy($source, $dest);
    }

    public static function getContent($filename)
    {
        if (!\file_exists($filename)) {
            return [];
        }

        return \file_get_contents($filename);
    }
}