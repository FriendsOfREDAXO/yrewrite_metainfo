<?php

class rex_var_domain_setting extends \rex_var
{
    protected function getOutput()
    {
        $key = $this->getParsedArg('key', null, true);
        if (null === $key) {
            return false;
        }
        return "Alexplusde\YrewriteMetainfo\Domain::getCurrentValue($key)";
    }
}
