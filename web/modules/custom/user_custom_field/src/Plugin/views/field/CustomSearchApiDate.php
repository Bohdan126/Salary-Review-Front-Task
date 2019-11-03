<?php

namespace Drupal\user_custom_field\Plugin\views\field;

use Drupal\search_api\Plugin\views\field\SearchApiFieldTrait;
use Drupal\search_api\Plugin\views\field\SearchApiStandard;


/**
 * Handles the display of custom date fields in Search API Views.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("search_api")
 */
class CustomSearchApiDate extends SearchApiStandard {

  use SearchApiFieldTrait;

  /**
   * {@inheritdoc}
   */
  public function render_item($count, $item) {
    $type = !empty($this->definition['filter_type']) ? $this->definition['filter_type'] : 'plain';
    return $this->t('Count of days: ') . $this->sanitizeValue($item['value'], $type);
  }

}
