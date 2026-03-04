<?php

namespace projectjoker\altextend\models;

use craft\base\Model;

/**
 * Plugin settings.
 *
 * @see \projectjoker\altextend\Plugin::createSettingsModel()
 */
class Settings extends Model
{
    /** The text appended or prepended to the alt attribute. */
    public string $text = '';

    /** Where to place the text: "suffix" (default) or "prefix". */
    public string $position = 'suffix';

    /** Characters placed between the original alt text and the configured text. */
    public string $separator = ' | ';

    protected function defineRules(): array
    {
        return [
            [['text'], 'required'],
            [['position'], 'in', 'range' => ['suffix', 'prefix']],
            [['separator'], 'string'],
        ];
    }
}
