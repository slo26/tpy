<?php

namespace Drupal\expense\Controller;

Use Drupal\Core\Ajax\CloseModalDialogCommand;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormBuilder;

/**
 * ModalFormExampleController class.
 */
class ExpenseController extends ControllerBase
{

    /**
     * The form builder.
     *
     * @var \Drupal\Core\Form\FormBuilder
     */
    protected $formBuilder;

    /**
     * The ModalFormExampleController constructor.
     *
     * @param \Drupal\Core\Form\FormBuilder $formBuilder
     *   The form builder.
     */
    public function __construct(FormBuilder $formBuilder)
    {
        $this->formBuilder = $formBuilder;
    }

    /**
     * {@inheritdoc}
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     *   The Drupal service container.
     *
     * @return static
     */
    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('form_builder')
        );
    }

    public function DepositeAllowanceForm() {
        $response = new AjaxResponse();
        $modal_form = $this->formBuilder->getForm('Drupal\expense\Form\DepositeAllowanceModalForm');
        $response->addCommand(new OpenModalDialogCommand('儲存零用金表格', $modal_form, ['width' => '300', 'height' => '340']));
        return $response;
    }
}

