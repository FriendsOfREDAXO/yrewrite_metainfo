<?php
class icon extends \rex_yform_manager_dataset
{
    public function getName() :string
    {
        return $this->getValue('name');
    }
    public function getShortName() :string
    {
        return $this->getValue('short_name');
    }
    public function getDisplay() :string
    {
        return $this->getValue('display');
    }
    public function getThemeColor() :string
    {
        return $this->getValue('theme_color');
    }
    public function getBackgroundColor() :string
    {
        return $this->getValue('background_color');
    }
    public function getTitleColor() :string
    {
        return $this->getValue('msapplication_title_color');
    }
    public function getFavicon() :string
    {
        return rex_url::media().$this->getValue('shortcut_icon');
    }
    public function getIcon($size = 32) :string
    {
        return rex_url::media().$this->getValue('icon_'.$size);
    }
    public function getTouchIcon() :string
    {
        return rex_file::media().$this->getValue('apple_touch_icon');
    }
    public function getPinnedTab() :string
    {
        return rex_url::media().$this->getValue('safari_pinned_tab');
    }
    public function getManifest() :string
    {
        return rex_url::media().$this->getValue('manifest');
    }
}
