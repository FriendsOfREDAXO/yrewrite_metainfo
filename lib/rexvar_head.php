<?php

namespace Alexplusde\YrewriteMetainfo;

use rex_var;

class rex_var_yrewrite_metainfo_head extends rex_var
{
    protected function getOutput()
    {
        return Domain::getHead();
    }
}
