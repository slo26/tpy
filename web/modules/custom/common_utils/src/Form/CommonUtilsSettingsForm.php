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

    $form['company'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('公司'),
      '#default_value' => $config->get('company'),
      '#size' => 50
    );
    $form['company_address'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('公司地址'),
      '#default_value' => $config->get('company_address'),
      '#size' => 50
    );
    $form['company_phone'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Tel'),
      '#default_value' => $config->get('company_phone'),
      '#size' => 50
    );
    $form['company_fax'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Fax'),
      '#default_value' => $config->get('company_fax'),
      '#size' => 50
    );
    $form['company_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Web'),
      '#default_value' => $config->get('company_url'),
      '#size' => 50
    );
    $form['company_email'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#default_value' => $config->get('company_email'),
      '#size' => 50
    );
    $form['sales_tax'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('營業稅率(%)'),
      '#default_value' => $config->get('sales_tax'),
      '#size' => 5
    );

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
      $settings->set('company', $form_state->getValue('company'));
      $settings->set('company_address', $form_state->getValue('company_address'));
      $settings->set('company_phone', $form_state->getValue('company_phone'));
      $settings->set('company_fax', $form_state->getValue('company_fax'));
      $settings->set('company_url', $form_state->getValue('company_url'));
      $settings->set('company_email', $form_state->getValue('company_email'));
      $settings->set('sales_tax', $form_state->getValue('sales_tax'));

      $settings->save();

    parent::submitForm($form, $form_state);
  }
}

