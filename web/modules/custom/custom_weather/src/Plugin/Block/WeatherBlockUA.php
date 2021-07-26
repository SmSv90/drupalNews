<?php

namespace Drupal\custom_weather\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Weather' Block.
 *
 * @Block(
 *   id = "weather_block_ua",
 *   admin_label = @Translation("Weather block UA"),
 *   category = @Translation("Custom Weather"),
 * )
 */
class WeatherBlockUA extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $client = \Drupal::httpClient();
    $request = $client->get('api.openweathermap.org/data/2.5/weather?q=Lutsk&units=metric&appid=d0c33cd5a7fb741a9d1f0f6db947d48e&lang=ua');
    $response = $request->getBody()->getContents();
    $responseParsed = json_decode($response, true);

    $cityName = [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => 'Локація: ' . $responseParsed['name']
    ];

    $temperatureValue = [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => 'Температура: ' . $responseParsed['main']['temp'] . ' град. Цельсія'
    ];

    $humidityValue= [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => 'Вологість: ' . $responseParsed['main']['humidity'] . ' %'
    ];

    $weatherValue= [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => 'Погода: ' . $responseParsed['weather'][0]['description']
    ];

    $windValue= [
      '#type' => 'html_tag',
      '#tag' => 'p',
      '#value' => 'Вітер: ' . $responseParsed['wind']['speed'] . ' м/с'
    ];

    return [
      $cityName,
      $weatherValue,
      $temperatureValue,
      $humidityValue,
      $windValue,
    ];
  }

}

