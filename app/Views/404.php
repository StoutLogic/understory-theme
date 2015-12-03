<?php
/**
 * 404 Page
 *
 */

use StoutLogic\UnderstoryTheme\Views;

$context = Timber::get_context();

$post = new TimberPost();
$context['post'] = $post;

Timber::render(array( '404.twig' ), $context);
