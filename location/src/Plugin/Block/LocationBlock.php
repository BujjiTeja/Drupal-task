<?php

namespace Drupal\location\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\location\Service\Location;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Provides a 'location_block' block.
 *
 * @Block(
 *  id = "location_block",
 *  admin_label = @Translation("Location block"),
 * )
 */
class LocationBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = \Drupal::config('location.adminsettings');
    $country = $config->get('country_name');
    $city = $config->get('city_name');
    $zone = $config->get('time_zone');
    $final_date = \Drupal::service('location_date.time')->getTime($zone);
    $new_date_time = explode('-',$final_date);
    $final_time = $new_date_time[1];
    $new_date = $new_date_time[0];
    $new_date_convert = strtotime($new_date);
    $final_new_date = date('l, d F Y', $new_date_convert);

   $renderable =  [
        '#theme' => 'location',
        '#time' => $final_time,
        '#date' => $final_new_date,
        '#city' => $city,
        '#country' => $country,
   
   ];
   return $renderable;
  }

  /**
   * @return int
   */
  public function getCacheMaxAge() {
    return 0;
  }

}