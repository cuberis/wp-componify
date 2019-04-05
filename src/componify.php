<?php

namespace Cuberis\Base;

class Componify {
  /**
   * The wrapping HTML element used on a component.
   *
   * @var string
   */
  public $htmlElem;

  /**
   * ID of the current post.
   *
   * @var int
   */
  public $post_id;

  /**
   * Optional prefix for components.
   *
   * @var string
   */
  public $prefix;

  /**
   * Constructor.
   *
   * @param string $prefix
   */
  public function __construct($prefix = null) {
    $this->htmlElem = get_theme_support('html5') ? 'section' : 'div';
    $this->post_id = get_the_ID();
    $this->prefix = $prefix;
  }

  /**
   * Handle HTML attributes for the component's wrapper.
   *
   * @param array $attributes
   * @return string
   */
  private function build_html_attributes(array $attributes) {
    $attrs = [];

    foreach ($attributes as $key => $val) {
      if (is_int($key)) {
        $attrs[] = $val;
      } else {
        $val = htmlspecialchars($val, ENT_QUOTES);
        $attrs[] = "{$key}=\"{$val}\"";
      }
    }

    return join(' ', $attrs);
  }

  /**
   * Open wrapping HTML element for component.
   *
   * @param string $slug
   */
  private function get_opening_elem($slug, $i) {
    $attrs = apply_filters('cuberis_set_component_html_attributes', [
      "class"      => "component component--{$slug}",
      "data-id"    => $this->post_id,
      "data-index" => $i
    ], $slug);

    echo "<{$this->htmlElem} {$this->build_html_attributes($attrs)}>";
  }

  /**
   * Close wrapping HTML element for component.
   */
  private function get_closing_elem() {
    echo "</{$this->htmlElem}>";
  }

  /**
   * Render components.
   */
  public function render() {
    /**
     * Exit early if ACF is not installed.
     */
    if (!function_exists('have_rows')) {
      throw new \Exception(__('Advanced Custom Fields PRO must be installed.'));
    }

    if (have_rows($this->prefix . 'components') && !post_password_required()) {
      while (have_rows($this->prefix . 'components')) {
        the_row();
        $i = get_row_index();
        $slug = sanitize_title_with_dashes(get_row_layout());

        /**
         * Render the component and wrapping HTML element!
         */
        $this->get_opening_elem($slug, $i);
        get_template_part('templates/components/component', $slug);
        $this->get_closing_elem();
      }
    } else {
      the_content();
    }
  }
}
