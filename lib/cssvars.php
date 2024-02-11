<?php

class cssvars extends rex_yform_manager_dataset
{
    public function getName(): string
    {
        return $this->getValue('name');
    }

    public function getVars(): array
    {
        return $this->getValue('vars');
    }
}
