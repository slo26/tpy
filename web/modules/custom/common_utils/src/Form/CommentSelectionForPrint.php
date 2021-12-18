<?php
namespace Drupal\common_utils\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure comment_selection_for_print settings for this site.
 */
class CommentSelectionForPrint extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'comment_selection_for_print';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'common_utils.comment_selection_for_print',
    ];
  }

  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('common_utils.comment_selection_for_print');

    $form['comment1'] = array(
        '#title' => $this->t('備註 (1):'),
        '#description' => $this->t('備註 (1).'),
        '#default_value' => $config->get('comment1'),
        '#type' => 'textarea',
        '#required' => false,
        '#rows' => 10,
        '#size' => 100,
    );

    $form['comment2'] = array(
        '#title' => $this->t('備註 (2):'),
        '#description' => $this->t('備註 (2).'),
        '#default_value' => $config->get('comment2'),
        '#type' => 'textarea',
        '#required' => false,
        '#rows' => 10,
        '#size' => 100,
    );

    $form['comment3'] = array(
        '#title' => $this->t('備註 (3):'),
        '#description' => $this->t('備註 (3).'),
        '#default_value' => $config->get('comment3'),
        '#type' => 'textarea',
        '#required' => false,
        '#rows' => 10,
        '#size' => 100,
    );

    $form['comment4'] = array(
        '#title' => $this->t('備註 (4):'),
        '#description' => $this->t('備註 (4).'),
        '#default_value' => $config->get('comment4'),
        '#type' => 'textarea',
        '#required' => false,
        '#rows' => 10,
        '#size' => 100,
    );

    $form['comment5'] = array(
        '#title' => $this->t('備註 (5):'),
        '#description' => $this->t('備註 (5).'),
        '#default_value' => $config->get('comment5'),
        '#type' => 'textarea',
        '#required' => false,
        '#rows' => 10,
        '#size' => 100,
    );

    $form['comment6'] = array(
        '#title' => $this->t('備註 (6):'),
        '#description' => $this->t('備註 (6).'),
        '#default_value' => $config->get('comment16'),
        '#type' => 'textarea',
        '#required' => false,
        '#rows' => 10,
        '#size' => 100,
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
      $settings = $this->configFactory->getEditable('common_utils.comment_selection_for_print');
      $settings->set('comment1', $form_state->getValue('comment1'));
      $settings->set('comment2', $form_state->getValue('comment2'));
      $settings->set('comment3', $form_state->getValue('comment3'));
      $settings->set('comment4', $form_state->getValue('comment4'));
      $settings->set('comment5', $form_state->getValue('comment5'));
      $settings->set('comment6', $form_state->getValue('comment6'));
      
      $settings->save();

    parent::submitForm($form, $form_state);
  }
}

