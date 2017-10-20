<?php

namespace Drupal\dct_paragraphs\Plugin\ViewBuilder;

use Drupal\entity_view_builder\EntityViewBuilderBase;

/**
 * Definition for sponsorship_package view builder alter.
 *
 * @EntityViewBuilder(
 *   id = "sponsorship_package_view_builder",
 *   bundle = "sponsorship_package"
 * )
 */
class SponsorshipPackageViewBuilder extends EntityViewBuilderBase {

  /**
   * {@inheritdoc}
   */
  public function build(array &$build) {
    $paragraph = $this->getEntity();
    $extraText = ($paragraph->get('field_text')->first()) ? $paragraph->get('field_text')->first()->value : NULL;

    // Add attributes for sponsorship category.
    $build['#attributes']['category'] = $this->getClassFromPackageTitle();

    if ($extraText) {
      // If the extra information field is completed, we add an attribute.
      $build['#attributes']['hasExtras'] = 'has-extras';
      $build['field_text'] = $build['field_text'][0];
    }

  }

  /**
   * Based on the title of the paragraph returns the proper css class.
   *
   * @return mixed|null
   *   Returns the needed class or null if the package type is not in $options.
   */
  protected function getClassFromPackageTitle() {
    $title = $this->entity->get('field_title')->first()->value;

    // Remove the whitespaces.
    preg_replace('/\s+/', '', $title);

    // Change the string to lowercase.
    $title = strtolower($title);

    return $title;
  }

}
