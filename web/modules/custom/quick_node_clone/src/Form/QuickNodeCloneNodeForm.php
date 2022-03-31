<?php

namespace Drupal\quick_node_clone\Form;

use Drupal\node\NodeForm;
use Drupal\Core\Form\FormStateInterface;

class QuickNodeCloneNodeForm extends NodeForm
{
  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $node = $this->entity;
    $insert = $node->isNew();
    $node->save();
    $node_link = $node->toLink($this->t('View'))->toString();
  
    if ( $insert ) {
      $this->logger('content')->notice($node->bundle() .', ' . $node->getTitle() . ' created.');
      \Drupal::messenger()->addMessage($node->getName() . ' has been created.');
    }

    if ($node->id()) {
      $form_state->setValue('nid', $node->id());
      $form_state->set('nid', $node->id());
      if ($node->access('view')) {
        $form_state->setRedirect(
          'entity.node.canonical',
          array('node' => $node->id())
        );
      } else {
        $form_state->setRedirect('<front>');
      }

    } else {
      \Drupal::messenger()->addMessage(t('The copyed post could not be saved.'), 'error');
      $form_state->setRebuild();
    }
  }
}

