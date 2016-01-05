<?php

namespace StoutLogic\UnderstoryTheme\Lib;

class AcfFieldGroups
{
    private static $rules;
    private static $fieldGroups;

    public static function init()
    {
        if (!is_array(self::$rules)) {
            self::$rules = array();
            self::$fieldGroups = array();

            \add_action('init', __NAMESPACE__ . '\AcfFieldGroups::registerFieldGroups', 100000);
        }

        if (!function_exists('\acf_add_local_field_group')) {
            return false;
        }
    }

    public static function initFieldGroup($fieldGroupConfig)
    {
        $key = $fieldGroupConfig['key'];

        if (!array_key_exists($key, self::$rules)) {
            self::$rules[$key] = array();
            self::$fieldGroups[$key] = $fieldGroupConfig;
        }
    }

    /**
     * Register a rule for a fieldGroup
     * You can pass a completed ACF Rule or a class name. If you pass through
     * a class name a rule will be created to match the page template or post type
     * depending on if the class is a View or a CustomPostType
     *
     * @param  mixed $rule             acf rule array or classname where a rule will be inferred
     * @param  array $fieldGroupConfig acf field group config
     */
    public function registerRule($rule, $fieldGroupConfig)
    {
        self::init();
        self::initFieldGroup($fieldGroupConfig);

        if (!is_array($rule)) {
            $className = $rule;
            if (is_subclass_of($className, '\Understory\View')) {
                $rule = array (
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'app/Views'.$className::getFileName().'.php'
                );
            } else if (is_subclass_of($className, '\Understory\CustomPostType')) {
                $rule = array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => $className::$cpt_name,
                );
            } else if (is_subclass_of($className, '\Understory\OptionPage')) {
                $rule = array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => $className->getId(),
                );
            } else if (is_subclass_of($className, '\Understory\User')) {
                $rule = array (
                    'param' => 'user_form',
                    'operator' => '==',
                    'value' => 'all',
                );
            }

        }

        array_push(self::$rules[$fieldGroupConfig['key']], array($rule));
    }

    /**
     * Registers the field groups after all rules have been collected
     */
    public static function registerFieldGroups()
    {
        foreach (self::$fieldGroups as $key => $fieldGroup) {
            $fieldGroup['location'] = self::$rules[$key];
            if (function_exists(acf_add_local_field_group)) {
                \acf_add_local_field_group($fieldGroup);
            }
        }
    }
}
