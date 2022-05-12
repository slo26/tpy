<?php
namespace Drupal\expense\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax;
use Drupal\Core\Url;
use \Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ModalForm.
 *
 * @package Drupal\expense\Form
 */
class DepositeAllowanceModalForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'deposite_allowance_modal_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['deposite_date'] = array(
      '#title' => '存入日期',
      '#type' => 'date',
      '#date_format' => 'yyyy-mm-dd',
      '#attributes' => [
        'id' => [
          'add-expense-modal-deposite-date',
        ],
      ],
    );

    $form['deposite_employee'] = [
			'#type' => 'entity_autocomplete',
			'#target_type' => 'user',
			'#title' => t('存款人'),
      '#attributes' => [
        'id' => 'edit-deposite-employee',
      ],
      '#size' => 23,
		];

    $form['new_allowance'] = array(
      '#title' => '儲存零用金',
      '#type' => 'textfield',
      '#attributes' => array('type' => 'number','id' => ['add-expense-new-allowance']),
      '#size' => 23,
    );

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => t('新增'),
      '#attributes' => [
        'class' => [
          'use-ajax',
        ],
        'id' => [
          'add-expense-modal-submit-buttom',
        ],
      ],
    ];

    $form['#attached']['library'][] = 'core/drupal.dialog.ajax';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state){ }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state){  }

  /**
   * Gets the configuration names that will be editable.
   *
   * @return array
   *   An array of configuration object names that are editable if called in
   *   conjunction with the trait's config() method.
   */
  protected function getEditableConfigNames() {
    return ['config.deposite_allowance_modal_form'];
  }
}

