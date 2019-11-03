<?php

namespace Drupal\user_custom_field\Plugin\views\filter;

use Drupal\Core\Form\FormStateInterface;
use Drupal\search_api\Plugin\views\filter\SearchApiString;
use Drupal\views\Plugin\views\filter\NumericFilter;

/**
 * Defines a custom filter for filtering on numeric values.
 *
 * @ingroup views_filter_handlers
 *
 * @ViewsFilter("search_api_string")
 */
class CustomSearchFilter extends NumericFilter {

  /**
   * {@inheritdoc}
   */
  public function operators() {
    $operators = parent::operators();
    $operators['data_range'] = [
        'title' => $this->t('Date Range'),
        'method' => 'opRange',
        'short' => $this->t('data range'),
        'values' => 2,
    ];

    return $operators;
  }

  /**
   * {@inheritdoc}
   */
  protected function valueForm(&$form, FormStateInterface $form_state) {
    parent::valueForm($form, $form_state);

      $form['value']['min'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Start count'),
        '#size' => 30,
        '#default_value' => $this->value['min'],
      ];
      $form['value']['max'] = [
        '#type' => 'textfield',
        '#title' => $this->t('End count'),
        '#size' => 30,
        '#default_value' => $this->value['max'],
      ];
  }
  /**
   * {@inheritdoc}
   */
  public function query() {
    $this->ensureMyTable();
    $field = "$this->tableAlias.$this->realField";

    $info = $this->operators();
    if (!empty($info[$this->operator]['method'])) {
      $this->{$info[$this->operator]['method']}($field);
    }
  }

  /**
   * {@inheritdoc}
   */
  protected function opRange($field) {
    if ($this->operator == 'data_range') {
      $this->query->addWhere($this->options['group'], $field, [$this->value['min'], $this->value['max']], 'BETWEEN');
    }
  }

}
