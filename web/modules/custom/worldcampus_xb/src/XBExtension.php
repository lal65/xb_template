<?php

namespace Drupal\worldcampus_xb;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Render\Markup;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class XBExtension extends AbstractExtension  {
  public function getFunctions() {
    return parent::getFunctions() + [
      new TwigFunction('is_xb_editing', [
        $this,
        'isXbEditing',
      ]),
    ];
  }

  public function getFilters()
  {
    return parent::getFilters() + [
       new TwigFilter('safe_html_in_props_hack', [
        $this,
        'safeHtmlInPropsHack',
      ]),
    ];
  }

  public function isXbEditing() {
    return str_starts_with(\Drupal::routeMatch()->getRouteName(), 'experience_builder.api');
  }

  public function safeHtmlInPropsHack(string $input) {
    return Markup::create(Xss::filter($input, ['em', 'strong', 'br', 'span', 'div']));
  }

}
