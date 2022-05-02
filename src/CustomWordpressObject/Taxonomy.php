<?php

namespace Copia\CustomWordpressObject;

use Copia\CustomWordpressObject;

final class Taxonomy extends CustomWordpressObject
{

    protected $objectType;

    /**
     * @param string       $key        Taxonomy key, must not exceed 32 characters
     * @param string|array $objectType Object type or array of object types with which the taxonomy should be associated
     * @param null|string  $singular   Specify singular label if different to $key
     * @param null|string  $plural     Specify plural label if not just a case of adding "s" to pluralise
     */
    public function __construct(string $key, $objectType, string $singular=null, string $plural=null)
    {
        $this->key        = $key;
        $this->objectType = $objectType;
        $this->singular   = $singular;
        $this->plural     = $plural;

        parent::__construct();
    }

    public function setShowTagcloud(bool $arg): Taxonomy
    {
        $this->args['show_tagcloud'] = $arg;
        return $this;
    }

    public function setShowInQuickEdit(bool $arg): Taxonomy
    {
        $this->args['show_in_quick_edit'] = $arg;
        return $this;
    }

    public function setShowAdminColumn(bool $arg): Taxonomy
    {
        $this->args['show_admin_column'] = $arg;
        return $this;
    }

    public function setMetaBoxCb($func): Taxonomy
    {
        $this->args['meta_box_cb'] = $func;
        return $this;
    }

    public function setMetaBoxSanitizeCb(callable $func): Taxonomy
    {
        $this->args['meta_box_sanitize_cb'] = $func;
        return $this;
    }

    public function setUpdateCountCallback(callable $func): Taxonomy
    {
        $this->args['update_count_callback'] = $func;
        return $this;
    }

    public function setDefaultTerm(array $args): Taxonomy
    {
        $this->args['default_term'] = $args;
        return $this;
    }

    public function setSort(bool $arg): Taxonomy
    {
        $this->args['sort'] = $arg;
        return $this;
    }

    public function register()
    {
        if ( !function_exists('register_taxonomy') ) {
            return;
        }
        register_taxonomy($this->key, $this->objectType, $this->args);
    }

    protected function generateLabels()
    {
        $this->generateSingularPluralFromKey();
        $this->setLabels([
            'name'                       => $this->plural,
            'singular_name'              => $this->singular,
            'search_items'               => "Search $this->plural",
            'popular_items'              => "Popular $this->plural",
            'all_items'                  => "All $this->plural",
            'parent_item'                => "Parent $this->singular",
            'parent_item_colon'          => "Parent $this->singular:",
            'edit_item'                  => "Edit $this->singular",
            'view_item'                  => "View $this->singular",
            'update_item'                => "Update $this->singular",
            'add_new_item'               => "Add New $this->singular",
            'new_item_name'              => "New $this->singular Name",
            'separate_items_with_commas' => "Separate " . strtolower($this->plural) . " with commas",
            'add_or_remove_items'        => "Add or remove " . strtolower($this->plural),
            'choose_from_most_used'      => "Choose from the most used " . strtolower($this->plural),
            'not_found'                  => "No " . strtolower($this->plural) . " found.",
            'no_terms'                   => "No " . strtolower($this->plural),
            'filter_by_item'             => "Filter by " . strtolower($this->singular),
            'items_list_navigation'      => "$this->plural list navigation",
            'items_list'                 => "$this->plural list",
            'back_to_items'              => "&larr; Go to $this->plural",
            'item_link'                  => "$this->singular Link",
            'item_link_description'      => "A link to a " . strtolower($this->singular) . ".",
        ]);
    }

}
