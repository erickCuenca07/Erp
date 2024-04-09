<?php

namespace Shared\Domain\Service;

class PpoUtf8Encoder
{
    public function utf8Encode($string): string
    {
        return mb_convert_encoding($string, "UTF-8", mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true));
    }

    public function utf8Decode($string): string
    {
        return mb_convert_encoding($string, "ISO-8859-1", mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true));
    }
}
