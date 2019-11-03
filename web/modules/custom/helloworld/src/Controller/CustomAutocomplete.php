<?php
/**
 * @file
 * Contains \Drupal\helloworld\Controller\CustomAutocomplete.
 */

namespace Drupal\helloworld\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Database\Database;
use Drupal\Component\Utility\Html;

class CustomAutocomplete {

  /**
   * Метод который будет возвращять результаты для автодополнения.
   *
   * {@inheritdoc}
   */
  public function autocomplete(Request $request) {

    $string = $request->query->get('q');

    $matches = [];

    if ($string) {

      $query = Database::getConnection()->select('user__field_full_name', 'u')
        ->fields('u', array('entity_id', 'field_full_name_value'))
        ->condition('u.field_full_name_value', '%' . $string . '%', 'LIKE')
        ->range(0, 10);

      $result = $query->execute();

      foreach ($result as $row) {
        $value = Html::escape($row->field_full_name_value . ' (' . $row->entity_id . ')');
        $label = Html::escape($row->field_full_name_value);
        $matches[] = ['value' => $value, 'label' => $label];
      }
    }

    return new JsonResponse($matches);
  }

}
