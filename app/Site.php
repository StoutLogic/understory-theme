<?php

namespace StoutLogic\UnderstoryTheme;

use StoutLogic\UnderstoryTheme\Config;
use StoutLogic\UnderstoryTheme\Helpers;
use StoutLogic\UnderstoryTheme\Lib;
use StoutLogic\UnderstoryTheme\Models;
use StoutLogic\UnderstoryTheme\OptionPages;
use StoutLogic\UnderstoryTheme\Taxonomies;
use StoutLogic\UnderstoryTheme\Views;

class Site extends \Understory\Site
{
    static protected $themeSupport = array(
        'post-formats',
        'post-thumbnails',
        'menus',
    );

    protected $editor;

    public function __construct()
    {
        parent::__construct();
    }

    public function enqueStylesheets()
    {

    }

    public function enqueAdminStylesheets()
    {
        \wp_enqueue_style('admin', \get_template_directory_uri().'/assets/dist/admin.css');
    }

    public function enqueScripts()
    {
        \wp_enqueue_script('main_js', \get_template_directory_uri().'/assets/dist/all.js', null, true);
        \wp_enqueue_script('modernizr', \get_template_directory_uri().'/assets/dist/modernizr.js', null, true);
    }

    public function registerNavigations()
    {

    }

    public function customizeAdminMenu()
    {
       
    }

    protected function addEditorConfig()
    {
        $this->editor = new Config\Editor();
    }

    public function registerPostTypes()
    {
        // $this->registerPostType('Models\Model');
    }

    public function registerViews()
    {
        // $this->registerView('Views\View');
    }

    public function registerTaxonomies()
    {
        // $this->registerTaxonomy('Taxonomies\Taxonomy');
    }

    public function registerOptionPages()
    {
        // $this->optionPages['option-page'] = new OptionPages\OptionPage();
    }

    public function initializeContext($context)
    {
        $context = parent::initializeContext($context);
        $context['menu'] = new \TimberMenu();
        $context['wp_nonce_field'] = \TimberHelper::function_wrapper('wp_nonce_field');
        return $context;
    }

    public function addToTwig($twig)
    {
        /* this is where you can add your own fuctions to twig */
        $twig->addFilter('imageUrl', new \Twig_Filter_Function(array( __NAMESPACE__ . '\\Helpers\\Image', 'url')));
        $twig->addFilter('jsonEncode', new \Twig_Filter_Function(array( __NAMESPACE__ . '\\Helpers\\Json', 'encode')));

        return parent::addToTwig($twig);
    }
}
