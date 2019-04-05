# Componify

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cuberis/wp-componify.svg?style=flat-square)](https://packagist.org/packages/cuberis/wp-componify)

Components, our flexible content system.

## Installing

`composer require cuberis/wp-componify`.

## Setup & Examples

1. Setup new template parts in `/templates/components/` to match against ACF Flexible Content layout slugs.
2. Instantiate new **Componify** class in your page template.
3. To enable the UI portion—declare theme support by `add_theme_support('components-ui')`.
4. Sit back and enjoy!

```php
<?php while (have_posts()) : the_post(); ?>
  <article>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
      <?php
        $components = new Componify();
        $components->render();
      ?>
    </div>
  </article>
<?php endwhile; ?>
```

## Arguments

* `prefix` (default: null) –  Retrieve a prefixed set of component fields.

## Filters

### `cuberis_set_component_html_attributes`

```php
/**
 * Example for modifying component wrapper attributes.
 *
 * @param array $attrs
 * @param string $slug
 * @return $attrs
 */
function cuberis_filter_component_html_attributes($attrs, $slug) {
  // Add a class modifier to just the text component.
  if ($slug === 'text') {
    $attrs['class'] .= ' component--example-modifier';
  }

  // Add a new attribute to all components.
  $attrs['data-unique-id'] = uniqid();

  return $attrs;
}
add_filter('cuberis_set_component_html_attributes', 'cuberis_filter_component_html_attributes', 10, 2);
```
