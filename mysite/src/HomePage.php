<?php

namespace {
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;
use SilverStripe\Forms\GridField\GridField;
    class HomePage extends Page
    {
        private static $db = [
            'Youtube' => 'Text',
        ];

        private static $has_one = [];

        private static $icon_class = 'font-icon-p-home';

        public function getCMSFields()
        {
            $fields = parent::getCMSFields();

            $conf = GridFieldConfig_RecordEditor::create(10);
            $conf->addComponent(new GridFieldSortableRows('SortOrder'));

            $fields->addFieldToTab('Root.Main', new TextField('Youtube', 'Youtube Embed URL'), 'Content');

            $fields->addFieldToTab('Root.Things', new GridField('Things', 'Things', Thing::get(), $conf));

            return $fields;
        }
    }
}
