<?php

namespace Drupal\user_custom_field\Plugin\views\sort;

use Drupal\views\Plugin\views\sort\SortPluginBase;

/**
 * Provides a sort plugin for Search API views.
 *
 * @ViewsSort("search_api")
 */
class CustomSearchApiSort extends SortPluginBase {

  /**
   * The associated views query object.
   *
   * @var \Drupal\search_api\Plugin\views\query\SearchApiQuery
   */
  public $query;

  /**
   * {@inheritdoc}
   */
  public function query() {
    if (isset($this->query->orderby)) {
      unset($this->query->orderby);
      $sort = &$this->query->getSort();
      $sort = [];
    }
    $this->query->sort($this->realField, $this->options['order']);
  }

}
