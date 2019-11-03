<?php
/**
 * @file
 * Contains \Drupal\helloworld\Form\AutocompleteExamples.
 */

namespace Drupal\helloworld\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Форма с примерами автодополнения.
 */
class AutocompleteExamples extends FormBase {

  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'autocomplete_examples';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['custom_autocomplete_field'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Custom autocomplete'),
      '#autocomplete_route_name' => 'helloworld.custom_autocomplete',
    ];

    $form['core_autocomplete'] = [
      '#title' => $this->t('Core autocomplete'),
      '#type' => 'entity_autocomplete',
      '#target_type' => 'user',
    ];

    $controller = \Drupal::entityManager()->getStorage('user');
    $controller->loadMultiple([1,2,3]);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {}

}
