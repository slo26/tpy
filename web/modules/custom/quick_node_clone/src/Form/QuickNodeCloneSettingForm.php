<?php

namespace Drupal\quick_node_clone\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class QuickNodeCloneSettingForm extends ConfigFormBase
{
  /**
   * {@inheritdoc}
   */
  public function getEditableConfigNames()
  {
    return ['quick_node_clone.settings'];
  }
  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'quick_node_clone_setting_form';
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('quick_node_clone.settings');

    $form['enable_node'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Enable Clone on Content Type'),
      '#default_value' => $config->get('enable_node'),
      '#description' => $this->t("If you would like to enable Clone feature on Node, Please add machine name of Node and use <b>,</b> in between."),
      '#size' => 200
    );
    
    return parent::buildForm($form, $form_state);
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $settings = $this->configFactory->getEditable('quick_node_clone.settings');
    $settings->set('enable_node', $form_state->getValue('enable_node'));
    $settings->save();

    parent::submitForm($form, $form_state);
  }
}
