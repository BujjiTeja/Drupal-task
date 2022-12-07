<?php

namespace Drupal\location\Service;

use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Location service.
 */
class Location {

  /**
   * Service to get the current time in the given format
   */
  public function getTime(string $zone) {
    $date = new DrupalDateTime;
    $date->setTimezone(new \DateTimeZone($zone));
    $final_date = $date->format('jS M Y - h:i A');
    return $final_date;
  }


}