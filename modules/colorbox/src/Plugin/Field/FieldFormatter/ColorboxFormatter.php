<?php

/**
 * @file
 * Contains \Drupal\colorbox\Plugin\Field\FieldFormatter\ColorboxFormatter.
 */

namespace Drupal\colorbox\Plugin\Field\FieldFormatter;

use Drupal\image\Plugin\Field\FieldFormatter\ImageFormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'colorbox' formatter.
 *
 * @FieldFormatter(
 *   id = "colorbox",
 *   module = "colorbox",
 *   label = @Translation("Colorbox"),
 *   field_types = {
 *     "image"
 *   }
 * )
 */
class ColorboxFormatter extends ImageFormatterBase {

  /**
   * {@inheritdoc}
   */
  public static function defaultSettings() {
    return array(
      'colorbox_node_style' => '',
      'colorbox_node_style_first' => '',
      'colorbox_image_style' => '',
      'colorbox_gallery' => 'post',
      'colorbox_gallery_custom' => '',
      'colorbox_caption' => 'auto',
      'colorbox_caption_custom' => '',
    ) + parent::defaultSettings();
  }

  /**
   * {@inheritdoc}
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $image_styles = image_style_options(FALSE);
    $image_styles_hide = $image_styles;
    $image_styles_hide['hide'] = t('Hide (do not display image)');
    $element['colorbox_node_style'] = array(
      '#title' => t('Content image style'),
      '#type' => 'select',
      '#default_value' => $this->getSetting('colorbox_node_style'),
      '#empty_option' => t('None (original image)'),
      '#options' => $image_styles_hide,
      '#description' => t('Image style to use in the content.'),
    );
    $element['colorbox_node_style_first'] = array(
      '#title' => t('Content image style for first image'),
      '#type' => 'select',
      '#default_value' => $this->getSetting('colorbox_node_style_first'),
      '#empty_option' => t('No special style.'),
      '#options' => $image_styles,
      '#description' => t('Image style to use in the content for the first image.'),
    );
    $element['colorbox_image_style'] = array(
      '#title' => t('Colorbox image style'),
      '#type' => 'select',
      '#default_value' => $this->getSetting('colorbox_image_style'),
      '#empty_option' => t('None (original image)'),
      '#options' => $image_styles,
      '#description' => t('Image style to use in the Colorbox.'),
    );

    $gallery = array(
      'post' => t('Per post gallery'),
      'page' => t('Per page gallery'),
      'field_post' => t('Per field in post gallery'),
      'field_page' => t('Per field in page gallery'),
      'custom' => t('Custom (with tokens)'),
      'none' => t('No gallery'),
    );
    $element['colorbox_gallery'] = array(
      '#title' => t('Gallery (image grouping)'),
      '#type' => 'select',
      '#default_value' => $this->getSetting('colorbox_gallery'),
      '#options' => $gallery,
      '#description' => t('How Colorbox should group the image galleries.'),
    );
    $element['colorbox_gallery_custom'] = array(
      '#title' => t('Custom gallery'),
      '#type' => 'textfield',
      '#default_value' => $this->getSetting('colorbox_gallery_custom'),
      '#description' => t('All images on a page with the same gallery value (rel attribute) will be grouped together. It must only contain lowercase letters, numbers, and underscores.'),
      '#required' => FALSE,
      '#states' => array(
        'visible' => array(
          ':input[name$="[settings_edit_form][settings][colorbox_gallery]"]' => array('value' => 'custom'),
        ),
      ),
    );
    $element['colorbox_token_gallery'] = array(
      '#type' => 'fieldset',
      '#title' => t('Replacement patterns'),
      '#description' => '<strong class="error">' . t('For token support the <a href="@token_url">token module</a> must be installed.', array('@token_url' => 'http://drupal.org/project/token')) . '</strong>',
      '#states' => array(
        'visible' => array(
          ':input[name$="[settings_edit_form][settings][colorbox_gallery]"]' => array('value' => 'custom'),
        ),
      ),
    );

    $caption = array(
      'auto' =>  t('Automatic'),
      'title' => t('Title text'),
      'alt' => t('Alt text'),
      'entity_title' => t('Content title'),
      'custom' => t('Custom (with tokens)'),
      'none' => t('None'),
    );
    $element['colorbox_caption'] = array(
      '#title' => t('Caption'),
      '#type' => 'select',
      '#default_value' => $this->getSetting('colorbox_caption'),
      '#options' => $caption,
      '#description' => t('Automatic will use the first none empty value of the title, the alt text and the content title.'),
    );
    $element['colorbox_caption_custom'] = array(
      '#title' => t('Custom caption'),
      '#type' => 'textfield',
      '#default_value' => $this->getSetting('colorbox_caption_custom'),
      '#states' => array(
        'visible' => array(
          ':input[name$="[settings_edit_form][settings][colorbox_caption]"]' => array('value' => 'custom'),
        ),
      ),
    );
    $element['colorbox_token_caption'] = array(
      '#type' => 'fieldset',
      '#title' => t('Replacement patterns'),
      '#description' => '<strong class="error">' . t('For token support the <a href="@token_url">token module</a> must be installed.', array('@token_url' => 'http://drupal.org/project/token')) . '</strong>',
      '#states' => array(
        'visible' => array(
          ':input[name$="[settings_edit_form][settings][colorbox_caption]"]' => array('value' => 'custom'),
        ),
      ),
    );

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = array();

    $image_styles = image_style_options(FALSE);
    // Unset possible 'No defined styles' option.
    unset($image_styles['']);
    // Styles could be lost because of enabled/disabled modules that defines
    // their styles in code.
    if (isset($image_styles[$this->getSetting('colorbox_node_style')])) {
      $summary[] = t('Content image style: @style', array('@style' => $image_styles[$this->getSetting('colorbox_node_style')]));
    }
    elseif ($this->getSetting('colorbox_node_style') == 'hide') {
      $summary[] = t('Content image style: Hide');
    }
    else {
      $summary[] = t('Content image style: Original image');
    }

    if (isset($image_styles[$this->getSetting('colorbox_node_style_first')])) {
      $summary[] = t('Content image style of first image: @style', array('@style' => $image_styles[$this->getSetting('colorbox_node_style_first')]));
    }

    if (isset($image_styles[$this->getSetting('colorbox_image_style')])) {
      $summary[] = t('Colorbox image style: @style', array('@style' => $image_styles[$this->getSetting('colorbox_image_style')]));
    }
    else {
      $summary[] = t('Colorbox image style: Original image');
    }

    $gallery = array(
      'post' => t('Per post gallery'),
      'page' => t('Per page gallery'),
      'field_post' => t('Per field in post gallery'),
      'field_page' => t('Per field in page gallery'),
      'custom' => t('Custom (with tokens)'),
      'none' => t('No gallery'),
    );
    if ($this->getSetting('colorbox_gallery')) {
      $summary[] = t('Colorbox gallery type: @type', array('@type' => $gallery[$this->getSetting('colorbox_gallery')])) . ($this->getSetting('colorbox_gallery') == 'custom' ? ' (' . $this->getSetting('colorbox_gallery_custom') . ')' : '');
    }

    $caption = array(
      'auto' =>  t('Automatic'),
      'title' => t('Title text'),
      'alt' => t('Alt text'),
      'entity_title' => t('Content title'),
      'custom' => t('Custom (with tokens)'),
      'none' => t('None'),
    );

    if ($this->getSetting('colorbox_caption')) {
      $summary[] = t('Colorbox caption: @type', array('@type' => $caption[$this->getSetting('colorbox_caption')]));
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items) {
    $elements = array();

    $entity = $items->getEntity();
    $settings = $this->getSettings();

    // Collect cache tags to be added for each item in the field.
    $cache_tags = array();
    if (!empty($settings['colorbox_node_style'])) {
      $image_style = entity_load('image_style', $settings['colorbox_node_style']);
      $cache_tags = $image_style->getCacheTags();
    }
    $cache_tags_first = array();
    if (!empty($settings['colorbox_node_style_first'])) {
      $image_style_first = entity_load('image_style', $settings['colorbox_node_style_first']);
      $cache_tags_first = $image_style_first->getCacheTags();
    }

    foreach ($items as $delta => $item) {
      if ($item->entity) {
        // Extract field item attributes for the theme function, and unset them
        // from the $item so that the field template does not re-render them.
        $item_attributes = $item->_attributes;
        unset($item->_attributes);

        if ($delta == 0 && !empty($settings['colorbox_node_style_first'])) {
          $settings['style_first'] = TRUE;
        }
        else {
          $settings['style_first'] = FALSE;
        }

        $elements[$delta] = array(
          '#theme' => 'colorbox_formatter',
          '#item' => $item,
          '#item_attributes' => $item_attributes,
          '#entity' => $entity,
          '#settings' => $settings,
          '#cache' => array(
            'tags' => $settings['style_first'] ? $cache_tags_first : $cache_tags,
          ),
        );
      }
    }

    return $elements;
  }

}
