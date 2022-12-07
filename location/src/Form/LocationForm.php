<?php  
/**  
 * @file  
 * Contains Drupal\location\Form\LocationForm.  
 */  
namespace Drupal\location\Form;  
use Drupal\Core\Form\ConfigFormBase;  
use Drupal\Core\Form\FormStateInterface;  
  
class LocationForm extends ConfigFormBase {  
  /**  
   * {@inheritdoc}  
   */  
  protected function getEditableConfigNames() {  
    return [  
      'location.adminsettings',  
    ];  
  }  
  
  /**  
   * {@inheritdoc}  
   */  
  public function getFormId() {  
    return 'location_form';  
  }

  /**  
   * {@inheritdoc}  
   */  
  public function buildForm(array $form, FormStateInterface $form_state) {  
    $config = $this->config('location.adminsettings');  
    $zones = [
        'America/Chicago' => 'America/Chicago',
        'America/New_York' => 'America/New_York',
        'Asia/Tokyo' => 'Asia/Tokyo',
        'Asia/Dubai' => 'Asia/Dubai',
        'Asia/Kolkata' => 'Asia/Kolkata',
        'Europe/Amsterdam' => 'Europe/Amsterdam',
        'Europe/Oslo' => 'Europe/Oslo',
        'Europe/London' => 'Europe/London',
    ];
   
    $form['city'] = [  
        '#type' => 'textfield',  
        '#title' => $this->t('City'),  
        '#description' => $this->t('Add city name'),  
        '#default_value' => $config->get('city_name'),  
    ];
    $form['country'] = [  
        '#type' => 'textfield',  
        '#title' => $this->t('Country'),  
        '#description' => $this->t('Add country name'),  
        '#default_value' => $config->get('country_name'),  
      ];
    $form['time_zone'] = [
        '#type' => 'select',
        '#title' => $this->t('Time zone'),
        '#options' => $zones,
        '#empty_value' => 0,
        '#empty_option' => $this->t('Select timezone'),
        '#default_value' => $config->get('time_zone'),
      ];
  
  
    return parent::buildForm($form, $form_state);  
  }

  /**  
   * {@inheritdoc}  
   */  
  public function submitForm(array &$form, FormStateInterface $form_state) {  
    parent::submitForm($form, $form_state);  
  
    $this->config('location.adminsettings')  
      ->set('country_name', $form_state->getValue('country'))  
      ->set('city_name', $form_state->getValue('city'))
      ->set('time_zone', $form_state->getValue('time_zone'))
      ->save();  
  }
}  