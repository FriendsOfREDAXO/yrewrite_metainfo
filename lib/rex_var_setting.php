<?php

namespace FriendsOfRedaxo\YrewriteMetainfo;

use rex_var;

class rex_var_domain_setting extends rex_var
{
    protected function getOutput(): string
    {
        $key = $this->getParsedArg('key', null, true);
        if (null === $key) {
            return false;
        }
        return "FriendsOfRedaxo\\YrewriteMetainfo\\Domain::getCurrentValue($key)";
    }
}
