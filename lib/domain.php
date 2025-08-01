<?php

namespace FriendsOfRedaxo\YrewriteMetainfo;

use Alexplusde\MediaManagerResponsive\Media;
use rex_fragment;
use rex_media;
use rex_path;
use rex_yform_manager_dataset;
use rex_yrewrite;
use rex_yrewrite_domain;

use function is_object;

use const PATHINFO_EXTENSION;

class Domain extends rex_yform_manager_dataset
{
    public static function getCurrent(): ?self
    {
        return self::query()->where('yrewrite_domain_id', rex_yrewrite::getCurrentDomain()->getId())->findOne();
    }

    /** @api */
    public static function getCurrentValue(string $key): mixed
    {
        $domain = self::getCurrent();
        if ($domain instanceof self) {
            return $domain->getValue($key);
        }
        return null;
    }

    public static function getHead(): string
    {
        $fragment = new rex_fragment();
        return $fragment->parse('yrewrite_metainfo/head.php');
    }

    /** @api */
    public function getYRewrite(): ?rex_yrewrite_domain
    {
        return rex_yrewrite::getDomainById($this->getYrewriteDomainId());
    }

    /** @api */
    public function getColor(): ?string
    {
        $icon = $this->getRelatedDataset('icon');
        if ($icon instanceof Icon) {
            return $icon->getThemeColor();
        }
        return null;
    }

    /** @api */
    public function getLogoImg(): ?string
    {
        if (class_exists('Media') && is_object(Media::get($this->getValue('logo')))) {
            return Media::get($this->getValue('logo'))->getImg();
        }
        if (is_object(rex_media::get($this->getValue('logo')))) {
            // Wenn Addon media_manager_responsive installiert ist, wird das responsive Bild zurückgegeben
            return rex_media::get($this->getValue('logo'))->getUrl();
        }
        return null;
    }

    /** Kann in einem Choice-Feld verwendet werden */
    /** @api
     * @return array<string,string>
     * */
    public static function getAvailableStyles(): array
    {
        $files = @scandir(rex_path::assets('styles'));
        if (false === $files) {
            $files = [];
        }
        $cssFiles = [];

        foreach ($files as $file) {
            if ('css' === pathinfo($file, PATHINFO_EXTENSION)) {
                $cssFiles[$file] = $file;
            }
        }

        return $cssFiles;
    }

    /** Kann in einem Choice-Feld verwendet werden */
    /** @api
     * @return array<string,string>
     * */
    public static function getAvailableScripts(): array
    {
        $files = scandir(rex_path::assets('scripts'));
        if (false === $files) {
            $files = [];
        }

        $jsFiles = [];

        foreach ($files as $file) {
            if ('js' === pathinfo($file, PATHINFO_EXTENSION)) {
                $jsFiles[$file] = $file;
            }
        }

        return $jsFiles;
    }

    /* Domain */
    /** @api */
    public function getYrewriteDomainId(): int
    {
        return $this->getValue('yrewrite_domain_id');
    }

    /** @api */
    public function setYrewriteDomainId(int $value): self
    {
        $this->setValue('yrewrite_domain_id', $value);
        return $this;
    }

    /* Website-Titel */
    /** @api */
    public function getName(): ?string
    {
        return $this->getValue('name');
    }

    /** @api */
    public function setName(mixed $value): self
    {
        $this->setValue('name', $value);
        return $this;
    }

    /* og:type */
    /** @api */
    public function getType(): ?string
    {
        return $this->getValue('type');
    }

    /** @api */
    public function setType(mixed $value): self
    {
        $this->setValue('type', $value);
        return $this;
    }

    /* og:image */
    /** @api */
    public function getThumbnail(bool $asMedia = false): mixed
    {
        if ($asMedia) {
            return rex_media::get($this->getValue('thumbnail'));
        }
        return $this->getValue('thumbnail');
    }

    /** @api */
    public function setThumbnail(string $filename): self
    {
        if (null !== rex_media::get($filename)) {
            $this->setValue('thumbnail', $filename);
        }
        return $this;
    }

    /* Logo */
    /** @api */
    public function getLogo(bool $asMedia = false): mixed
    {
        if ($asMedia) {
            return rex_media::get($this->getValue('logo'));
        }
        return $this->getValue('logo');
    }

    /** @api */
    public function setLogo(string $filename): self
    {
        if (null !== rex_media::get($filename)) {
            $this->setValue('logo', $filename);
        }
        return $this;
    }

    /* Profil (Icons, PWA) */
    /** @api */
    public function getIcon(): ?rex_yform_manager_dataset
    {
        return $this->getRelatedDataset('icon');
    }

    /* JS-Dateien */
    /** @api
     * @return array<int,string>
     * */
    public function getScripts(): ?array
    {
        return explode(',', $this->getValue('scripts'));
    }

    /** @api
     * @param array<mixed,string> $value
     */
    public function setScripts(array $value): self
    {
        $this->setValue('scripts', implode(',', $value));
        return $this;
    }

    /* CSS-Dateien */
    /** @api
     * @return array<int,string>
     * */
    public function getStyles(): ?array
    {
        return explode(',', $this->getValue('styles'));
    }

    /** @api
     * @param array<mixed,string> $value
     */
    public function setStyles(array $value): self
    {
        $this->setValue('styles', implode(',', $value));
        return $this;
    }
}
