<?php

namespace PrestaShop\EmailGenerator;

class SubjectTranlationsGenerator
{
    public function dictionaryToArray($name, $data, $global = true)
    {
        $str = "<?php\n\n";
        if ($global) {
            $str .= 'global $'.$name.";\n";
        }
        $str .= '$'.$name." = array();\n\n";

        foreach ($data as $key => $value) {
            if (trim($value) != '') {
                $str .= '$'.$name.'['.$this->quote($key).'] = '.$this->quote($value).";\n";
            }
        }

        $str .= "\n\nreturn ".'$'.$name.";\n";

        return $str;
    }

    public function writeTranslations($data)
    {
        foreach ($data as $relFilePath => $newTranslations) {
            if (($absPath = $this->isValidTranslationFilePath($relFilePath)) !== false) {
                $currentTranslations = $this->getTranslations($absPath);
                $translations = array_merge($currentTranslations, $newTranslations);
                $phpArray = $this->dictionaryToArray('_LANGMAIL', $translations);
                $dir = dirname($absPath);
                if (!is_dir($dir)) {
                    if (!@mkdir($dir, 0777, true)) {
                        return $this->l('Could not create directory: ').dirname($relFilePath);
                    }
                }
                $fh = fopen($absPath, 'w');
                if (!$fh) {
                    return $this->l('Could not open for writing: ').$relFilePath;
                }
                if (flock($fh, LOCK_EX)) {
                    fwrite($fh, $phpArray);
                    fflush($fh);
                    flock($fh, LOCK_UN);
                    fclose($fh);
                } else {
                    return $this->l('Could not acquire lock on translation file.');
                }
            } else {
                return $this->l('Invalid translation file path: ').$relFilePath;
            }
        }

        return true;
    }
}
