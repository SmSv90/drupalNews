<?php
/**
 * @file
 * Contains \Drupal\custom_weather\Controller\WeatherController.
 */
namespace Drupal\custom_weather\Controller;
class WeatherController {
  public function content() {
    return array(
      '#type' => 'markup',
      '#markup' => t('Hello, World! It is custom weather!'),
    );
  }
}
