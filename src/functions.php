<?php
// Function to put the translations in the templates
function t($str)
{
    global $EMAIL_TRANSLATIONS_DICTIONARY;

    if (isset($EMAIL_TRANSLATIONS_DICTIONARY[$str]) && trim($EMAIL_TRANSLATIONS_DICTIONARY[$str]) !== '') {
        return $EMAIL_TRANSLATIONS_DICTIONARY[$str];
    } else {
        return $str;
    }
}
