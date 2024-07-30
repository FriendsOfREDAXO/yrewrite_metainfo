<?php

namespace Alexplusde\YrewriteMetainfo;

use rex_var;

class rex_var_yrewrite_domain_meta_head extends rex_var
{
    protected function getOutput()
    {
        return Domain::getHead();
    }
}
