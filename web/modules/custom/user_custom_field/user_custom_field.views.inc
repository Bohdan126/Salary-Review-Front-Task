<?php

/**
 * @file
 * Views hooks.
 */

/**
 * Implements hook_views_data_alter().
 *
 * Alter DB tables defined via hook_views_data().
 */
function user_custom_field_views_data_alter(array &$data) {
  $data['users_field_data']['mycustom_field'] = [
    'title' => t('User custom field'),
    'field' => [
      'title' => t('User custom field'),
      'help' => t('User custom field'),
      'id' => 'mycustom_field',
    ],
  ];
}
