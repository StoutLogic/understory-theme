<?php

namespace StoutLogic\DPatents\Config;

class Editor extends \Understory\Config\Editor
{

    protected function init()
    {
        parent::init();
        $this->customizeButtons();
    }

    public function addStyleSheet()
    {
        add_editor_style('assets/dist/editor.css');
    }

    public function customizeButtons()
    {
        \add_filter('tiny_mce_before_init', function ($init) {
            $init['block_formats'] = 'Paragraph=p; Heading=h2';
            return $init;
        });

        \add_filter('mce_buttons', function ($buttons) {
            $buttons = array(
                'formatselect',
                'blockquote',
                '|',
                'bold',
                'italic',
                'underline',
                'strikethrough',
                '|',
                'bullist',
                'numlist',
                'indent',
                'outdent',
                '|',
                'link',
                'unlink',
                '|',
                'wp_adv',
            );
            return $buttons;
        });

        \add_filter('mce_buttons_2', function ($buttons) {
            $buttons = array(
                'undo',
                'redo',
                '|',
                'superscript',
                'subscript',
                '|',
                'removeformat',
                'charmap',
                '|',
                'wp_help',
            );
            return $buttons;
        });
    }
}
