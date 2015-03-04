<?php

/**
 * @file
 * Contains \Drupal\foo\FooSettingsForm
 */

namespace Drupal\foo\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class FooSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'foo.settings';
  }

  /**
   * {@inheritdoc}
   */
  public function getEditableConfigNames() {
    return [
        'foo.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('foo.settings');
    $form['foo_text1'] = array(
        '#type' => 'textfield',
        '#title' => t('Title'),
        '#default_value' => $config->get('text1'),
        '#size' => 60,
        '#maxlength' => 128,
    );
    $form['foo_text2'] = array(
        '#type' => 'textfield',
        '#title' => t('Count'),
        '#default_value' => $config->get('text2'),
        '#size' => 60,
        '#maxlength' => 128,
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (!is_numeric($form_state->getValue('foo_text2'))) {
      $form_state->setErrorByName('foo_text2', t('Please enter only numeric value.'));
    }

    return parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('foo.settings')
            ->set('text1', $form_state->getValue('foo_text1'))
            ->set('text2', $form_state->getValue('foo_text2'))
            ->save();

    return parent::submitForm($form, $form_state);
  }

}
