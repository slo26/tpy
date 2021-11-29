<?php
namespace Drupal\common_utils\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure common_utils settings for this site.
 */
class CommonUtilsSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'common_utils_form';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'common_utils.settings',
    ];
  }

  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('common_utils.settings');

    $form['hostname'] = array(
        '#type' => 'textfield',
        '#title' => $this->t('Hostname'),
        '#default_value' => $config->get('hostname'),
        '#size' => 50
      );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
      parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
      $settings = $this->configFactory->getEditable('common_utils.settings');
      $settings->set('hostname', $form_state->getValue('hostname'));
      $settings->save();

    parent::submitForm($form, $form_state);
  }
}
