<?php

namespace Drupal\custom_weather\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Weather' Block.
 *
 * @Block(
 *   id = "weather_block",
 *   admin_label = @Translation("Weather block"),
 *   category = @Translation("Custom Weather"),
 * )
 */
class WeatherBlock extends BlockBase
{

  /**
   * {@inheritdoc}
   */
    public function build()
    {

        $url = 'api.openweathermap.org/data/2.5/weather?q=Lutsk&units=metric&appid=d0c33cd5a7fb741a9d1f0f6db947d48e';
        $client = \Drupal::httpClient();
        $request = $client->get($url);
        $response = $request->getBody()->getContents();
        $responseParsed = json_decode($response, true);

        $cityName = [
          '#type' => 'html_tag',
          '#tag' => 'p',
          '#value' => 'Location: ' . $responseParsed['name'],
          '#attributes' => [
            'class' => ['weather-block-location'],
          ]
        ];

        $temperatureValue = [
          '#type' => 'html_tag',
          '#tag' => 'p',
          '#value' => 'Temperature: ' . round($responseParsed['main']['temp']) . '&#x2103;',
          '#attributes' => [
            'class' => ['weather-block-temperature'],
          ]
        ];

        $humidityValue= [
          '#type' => 'html_tag',
          '#tag' => 'p',
          '#value' => 'Humidity: ' . $responseParsed['main']['humidity'] . ' %',
          '#attributes' => [
            'class' => ['weather-block-humidity'],
          ]
        ];

        $weatherValue= [
          '#type' => 'html_tag',
          '#tag' => 'p',
          '#value' => 'Weather: ' . $responseParsed['weather'][0]['description'],
          '#attributes' => [
            'class' => ['weather-block-weather'],
          ]
        ];

        $windValue= [
          '#type' => 'html_tag',
          '#tag' => 'p',
          '#value' => 'Wind: ' . $responseParsed['wind']['speed'] . ' m/s',
          '#attributes' => [
            'class' => ['weather-block-wind'],
          ]
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
