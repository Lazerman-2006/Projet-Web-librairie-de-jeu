<?php


namespace Html;
trait StringEscaper
{
    public function escapeString(?string $string): ?string
    {
        return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    protected function stripTagsAndTrim(?string $value): string
    {
        if ($value === null) {
            return '';
        }

        return trim(strip_tags($value));
    }

}
