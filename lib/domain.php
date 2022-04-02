<?php
class yrewrite_domain_meta extends \rex_yform_manager_dataset
{
    public static function getCurrent()
    {
        self::query()->where('yrewrite_domain_id', rex_yrewrite::getCurrent()->getId())->findOne();
    }
    
    public function getYRewrite()
    {
        return rex_yrewrite::getDomainById($this->getValue('yrewrite_domain_id'));
    }

    public function getTitle() :string
    {
        return $this->title;
    }

    public function getCssVars() :string
    {
        return $this->cssvars;
    }

    public function getColor() :string
    {
        return $this->color;
    }

    public function getLogo() :string
    {
        return $this->logo;
    }

    public function getFavicon() :string
    {
        return $this->favicon;
    }
}
