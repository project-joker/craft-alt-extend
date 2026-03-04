<?php

namespace projectjoker\altextend;

use Craft;
use craft\base\Model;
use projectjoker\altextend\models\Settings;
use projectjoker\altextend\twig\AltTextExtension;

/**
 * Alt Extend plugin for Craft CMS 5.
 *
 * Extends image alt attributes with a configurable text
 * through a simple Twig filter.
 */
class Plugin extends \craft\base\Plugin
{
    public bool $hasCpSettings = true;

    public string $schemaVersion = '1.0.0';

    public function init(): void
    {
        parent::init();

        Craft::$app->onInit(function () {
            Craft::$app->getView()->registerTwigExtension(
                new AltTextExtension()
            );
        });
    }

    protected function createSettingsModel(): ?Model
    {
        return new Settings();
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->getView()->renderTemplate(
            'alt-extend/settings',
            ['settings' => $this->getSettings()]
        );
    }
}
