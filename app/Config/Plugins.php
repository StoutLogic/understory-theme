<?php

namespace StoutLogic\DPatents\Config;

class Plugins extends \Understory\Config\Plugins
{
  /*
   * Array of plugin arrays. Required keys are name and slug.
   * If the source is NOT from the .org repo, then source is also required.
   */
    static protected $plugins = array(
      array(
        'name' => 'Advanced Custom Fields Pro',
        'slug' => 'advanced-custom-fields-pro',
        'required' => true,
        'source' => 'http://connect.advancedcustomfields.com/index.php?p=pro&a=download&k=b3JkZXJfaWQ9NDA5NzN8dHlwZT1wZXJzb25hbHxkYXRlPTIwMTQtMDktMzAgMTQ6NDE6MDg=',
      ),
      array(
        'name' => 'Simple Custom Post Order',
        'slug' => 'simple-custom-post-order',
        'required' => false,
      ),
      array(
        'name' => 'Updraft Plus',
        'slug' => 'updraftplus',
        'required' => false,
      ),
    );
}
