<?php

namespace projectjoker\altextend\migrations;

use Craft;
use craft\db\Migration;
use craft\fields\Lightswitch;

/**
 * Install migration.
 *
 * Creates a Lightswitch field (handle: altExtendDisabled) that allows
 * content editors to disable alt text extension on individual assets.
 */
class Install extends Migration
{
    public function safeUp(): bool
    {
        $fieldsService = Craft::$app->getFields();

        if (!$fieldsService->getFieldByHandle('altExtendDisabled')) {
            $field = new Lightswitch();
            $field->name = 'Disable Alt Extend';
            $field->handle = 'altExtendDisabled';
            $field->default = false;

            if (!$fieldsService->saveField($field)) {
                return false;
            }
        }

        return true;
    }

    public function safeDown(): bool
    {
        $fieldsService = Craft::$app->getFields();
        $field = $fieldsService->getFieldByHandle('altExtendDisabled');

        if ($field) {
            $fieldsService->deleteField($field);
        }

        return true;
    }
}
