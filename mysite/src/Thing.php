<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\TextField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\AssetAdmin\Forms\UploadField;

class Thing extends DataObject
{
    private static $db = [
        'Title' => 'Varchar',
        'SortOrder' => 'Int',
        'Content' => 'HTMLText',
    ];
    private static $has_one = array(

        "MainImage" => Image::class,

    );

    private static $owns = array(
        'MainImage'
    );

    private static $default_sort = 'SortOrder';

        public function getCMSFields()
        {
            $fields = parent::getCMSFields();
            $fields->removeByName('SortOrder');

            $fields->addFieldToTab('Root.Main', new TextField('Title'));
            $fields->addFieldToTab('Root.Main', new UploadField('MainImage', 'Photo'));
            $fields->addFieldToTab('Root.Main', new HTMLEditorField('Content'));
            return $fields;

            return $fields;
        }
}
