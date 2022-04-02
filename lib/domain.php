<?php
class domain extends \rex_yform_manager_dataset
{
    public static function getCurrent()
    {
        return self::query()->where('yrewrite_domain_id', rex_yrewrite::getCurrentDomain()->getId())->findOne();
    }
    
    public static function getHead()
    {
        $fragment = new rex_fragment();
        return $fragment->parse('yrewrite_metainfo/head.php');
    }

    public function getYRewrite()
    {
        return rex_yrewrite::getDomainById($this->getValue('yrewrite_domain_id'));
    }

    public function getName() :string
    {
        return $this->getValue('name');
    }

    public function getCssVars()
    {
        return $this->getRelatedDataset('cssvars');
    }

    public function getIcon()
    {
        return $this->getRelatedDataset('icon');
    }

    public function getColor() :string
    {
        $icon = $this->getRelatedDataset('icon');
        if ($icon) {
            return $this->getRelatedDataset('icon')->getColor();
        }
        return "";
    }

    public function getLogo() :string
    {
        return $this->getValue('logo');
    }

    public function getType() :string
    {
        return $this->getValue('type');
    }
}
