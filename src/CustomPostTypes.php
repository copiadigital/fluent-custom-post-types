<?php

namespace Copia;

use Copia\CustomWordpressObject\PostType;
use Copia\CustomWordpressObject\Taxonomy;

final class CustomPostTypes
{

    public static function register(array $types)
    {
        foreach ( $types as $type ) {
            add_action('init', function() use ($type) {
                $type->register();
            });
        }
    }

    public static function createPostType(string $postType, string $singular=null, string $plural=null): PostType
    {
        return new PostType($postType, $singular, $plural);
    }

    public static function createTaxonomy(string $taxonomy, $objectType, string $singular=null, string $plural=null): Taxonomy
    {
        return new Taxonomy($taxonomy, $objectType, $singular, $plural);
    }

}
