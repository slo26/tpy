<?php

/**
 * @file
 * Definition of \Drupal\ckeditor_moverow\Plugin\CKEditorPlugin\CkeditorMoveRow.
 */

namespace Drupal\ckeditor_moverow\Plugin\CKEditorPlugin;

use Drupal\ckeditor\CKEditorPluginBase;
use Drupal\editor\Entity\Editor;

/**
 * Defines the "Bootstrap Buttons" plugin.
 *
 * @CKEditorPlugin(
 *   id = "moverow",
 *   label = @Translation("Move Row")
 * )
 */
class CkeditorMoveRow extends CKEditorPluginBase {
    /**
    * Implements \Drupal\ckeditor\Plugin\CKEditorPluginInterface::isInternal().
    */
    public function isInternal() {
        return FALSE;
    }

    /**
    * Implements \Drupal\ckeditor\Plugin\CKEditorPluginInterface::getFile().
    */
    public function getFile() {
        return $this->getPluginPath() . '/plugin.js';
    }

    /**
    * {@inheritdoc}
    */
    public function getLibraries(Editor $editor) {
        return [];
    }

    /**
    * Implements \Drupal\ckeditor\Plugin\CKEditorPluginButtonsInterface::getButtons().
    */
    public function getButtons() {
        return [
            'moverow_up' => [
            'label' => $this->t('Move Row Up'),
            'image' => $this->getPluginPath() . '/icons/moverow_up.png',
            ],
            'moverow_down' => [
                'label' => $this->t('Move Row Down'),
                'image' => $this->getPluginPath() . '/icons/moverow_down.png',
              ],
        ];
    }

    /**
    * {@inheritdoc}
    */
    public function getConfig(Editor $editor) {
        return [];
    }

    /**
    * Return ckeditor tabletoolstoolbar plugin path relative to drupal root.
    *
    * @return string
    *   Relative path to the ckeditor plugin folder
    */
    private function getPluginPath() {
        return 'libraries/moverow';
    }
  

}