<?php

namespace Alexplusde\YrewriteMetainfo;

use rex_addon;
use rex_fragment;
use rex_media;
use rex_media_plus;
use rex_path;
use rex_yform_manager_dataset;
use rex_yrewrite;
use rex_yrewrite_domain;

use const PATHINFO_EXTENSION;

class Domain extends rex_yform_manager_dataset
{
    public static function getCurrent(): ?self
    {
        return self::query()->where('yrewrite_domain_id', rex_yrewrite::getCurrentDomain()->getId())->findOne();
    }

    public static function getHead(): string
    {
        $fragment = new rex_fragment();
        return $fragment->parse('yrewrite_metainfo/head.php');
    }

    public function getYRewrite(): ?rex_yrewrite_domain
    {
        return rex_yrewrite::getDomainById($this->getValue('yrewrite_domain_id'));
    }

    public function getColor(): string
    {
        $icon = $this->getRelatedDataset('icon');
        if ($icon) {
            return $this->getRelatedDataset('icon')->getValue('color');
        }
        return '';
    }

    public function getLogoImg(): ?string
    {
        if ($this->getValue('logo')) {
            // Wenn Addon media_manager_responsive installiert ist, wird das responsive Bild zurückgegeben
            if (rex_addon::get('media_manager_responsive')->isAvailable()) {
                return rex_media_plus::get($this->getValue('logo'))->getImg();
            }
            return rex_media::get($this->getValue('logo'))->getUrl();
        }
        return null;
    }

    public static function getAvailableStyles(): array
    {
        if (!$files = @scandir(rex_path::assets('styles'))) {
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

    public static function getAvailableScripts(): array
    {
        if (!$files = @scandir(rex_path::assets('scripts'))) {
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
    public function getYrewriteDomainId(): ?string
    {
        return $this->getValue('yrewrite_domain_id');
    }

    /** @api */
    public function setYrewriteDomainId(mixed $value): self
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
        if (rex_media::get($filename)) {
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
        if (rex_media::get($filename)) {
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
    /** @api */
    public function getScripts(): ?array
    {
        return explode(',', $this->getValue('scripts'));
    }

    /** @api */
    public function setScripts(array $value): self
    {
        $this->setValue('scripts', implode(',', $value));
        return $this;
    }

    /* CSS-Dateien */
    /** @api */
    public function getStyles(): ?array
    {
        return explode(',', $this->getValue('styles'));
    }

    /** @api */
    public function setStyles(array $value): self
    {
        $this->setValue('styles', implode(',', $value));
        return $this;
    }
}
