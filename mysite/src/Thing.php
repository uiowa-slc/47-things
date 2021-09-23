<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\TextField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\ORM\ArrayList;


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
    public function ImageLookup(){
        $page = $this->data();
        $images = new ArrayList();

        $tries = array(

            'FeaturedImage',
            'MainImage',
            'HeaderImage',
            'Photo',
            'BackgroundImage',
            'HeroImage',
            'MainPhoto',
            'ProgramPhoto',
            'Image',
            'StaffPhoto',
            'TestimonialPhoto',
            'Program1Photo',
            'Program2Photo',
            'Program3Photo',
            'DefaultPhoto',
            'AboutUsFeature1Photo',
            'AboutUsFeature2Photo'

        );

        //Try the above image fields
        foreach($tries as $t) {
            // echo $t;
            $i = $page::getSchema()->hasOneComponent($page, $t);
            // echo $i;
            if($i) {
                if($page->getComponent($t)->exists()){
                    // echo 'component exists: '.$i;
                    $images->push($page->getComponent($t));
                }
            }
        }






        return $images;

    }
}
