<?php

namespace atuin\static_page\config;


use atuin\apps\models\Plugin;
use atuin\engine\models\Page;
use atuin\engine\models\PageDesign;
use atuin\engine\models\PageReference;
use atuin\engine\models\PageSections;
use atuin\static_page\models\StaticPlugin;


/**
 * Class ConfigSkeleton
 * @package common\engine\module_skeleton\libraries
 *
 * Class called to install a module in the CMS.
 *
 * Here must be all the automatic changes in the system that will be necessary to install a new module.
 *
 */
class AtuinConfig extends \atuin\skeleton\config\AtuinConfig
{

    /**
     * @inheritdoc
     */
    public function upMigration()
    {

    }

    /**
     * @inheritdoc
     */
    public function downMigration()
    {

    }

    /**
     * @inheritdoc
     */
    public function upMenu()
    {
        $this->menuItems->add_menu_item('pages_static', '@web/pages/static', 'pages_head', 'Static Pages', 'file-text', NULL);
    }


    /**
     * @inheritdoc
     */
    public function downMenu()
    {
        $this->menuItems->delete_menu_item('pages_static');
    }

    /**
     * @inheritdoc
     */
    public function upConfig()
    {
    }


    /**
     * @inheritdoc
     */
    public function downConfig()
    {
    }

    /**
     * @inheritdoc
     */
    public function upManual()
    {
        // Adds the static page
        $page = new Page();
        $page->name = 'Static page';
        $page->parameters = json_encode([['class' => StaticPlugin::className()]]);
        $page->save();

        // Adds the static page plugin
        // used in the static pages
        $plugin = new Plugin();
        $plugin->namespace = StaticPlugin::className();
        $plugin->private = TRUE;
        $plugin->save();

        // Adds the basic Page Sections

        $oneColSection = PageSections::findOne(['name' => 'One column']);

        if (is_null($oneColSection))
        {
            $section = new PageSections();
            $section->name = 'One column';
            $section->cols = 1;
            $section->cols_sizes = '12';
            $section->save();
        }
        else
        {
            $section = $oneColSection;
        }


        // Adds the Static Page Design
        $pageReference = new PageReference();
        $pageReference->page_id = $page->id;
        $pageReference->save();

        $pageDesign = new PageDesign();
        $pageDesign->page_reference_id = $pageReference->id;
        $pageDesign->section_id = $section->id;
        $pageDesign->plugins = json_encode([[$plugin->id]]);
        $pageDesign->save();

    }


    /**
     * @inheritdoc
     */
    public function downManual()
    {
        // TODO mejorar el borrador

        /** @var Page $staticPage */
    //    $staticPage = Page::findOne(['name' => 'Static page']);

     //   Plugin::deleteAll(['namespace' => StaticPlugin::className()]);

       // $pageReferences = PageReference::find()->where(['page_id'])->select('id')->all();



     //   PageReference::deleteAll(['page_id' => $staticPage->id]);


    }

}