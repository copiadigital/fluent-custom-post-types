<?php

namespace Copia\CustomWordpressObject;

use Copia\CustomWordpressObject;

final class PostType extends CustomWordpressObject
{

    /**
     * @param string      $key      The post_type to be registered
     * @param null|string $singular Specify singular label if different to $key
     * @param null|string $plural   Specify plural label if not just a case of adding "s" to pluralise
     */
    public function __construct(string $key, string $singular=null, string $plural=null)
    {
        $this->key      = $key;
        $this->singular = $singular;
        $this->plural   = $plural;
        parent::__construct();
    }

    protected function generateLabels()
    {
        $this->generateSingularPluralFromKey();
        $this->setLabels([
            'name'                     => $this->plural,
            'singular_name'            => $this->singular,
            'add_new_item'             => "Add New $this->singular",
            'add_new'                  => "Add New $this->singular",
            'edit_item'                => "Edit $this->singular",
            'new_item'                 => "New $this->singular",
            'view_item'                => "View $this->singular",
            'view_items'               => "View $this->plural",
            'search_items'             => "Search $this->plural",
            'not_found'                => "No " . strtolower($this->plural) . " found.",
            'not_found_in_trash'       => "No " . strtolower($this->plural) . " found in Bin.",
            'parent_item_colon'        => "Parent $this->singular:",
            'all_items'                => "All $this->plural",
            'archives'                 => "$this->singular Archives",
            'attributes'               => "$this->singular Attributes",
            'insert_into_item'         => "Insert into " . strtolower($this->singular),
            'uploaded_to_this_item'    => "Uploaded to this " . strtolower($this->singular),
            'filter_items_list'        => "Filter " . strtolower($this->plural) . " list",
            'items_list_navigation'    => "$this->plural list navigation",
            'items_list'               => "$this->plural list",
            'item_published'           => "$this->singular published.",
            'item_published_privately' => "$this->singular published privately.",
            'item_reverted_to_draft'   => "$this->singular reverted to draft.",
            'item_scheduled'           => "$this->singular scheduled.",
            'item_updated'             => "$this->singular updated.",
            'item_link'                => "$this->singular Link",
            'item_link_description'    => "A link to a " . strtolower($this->singular) . "."
        ]);
    }

    /**
     * @param string $arg Name of the post type shown in the menu. Usually plural. Default is value of $labels['name'].
     * @return $this
     */
    public function setLabel(string $arg): PostType
    {
        $this->args['label'] = $arg;
        return $this;
    }

    public function setExcludeFromSearch(bool $arg): PostType
    {
        $this->args['exclude_from_search'] = $arg;
        return $this;
    }

    public function setShowInAdminBar(bool $arg): PostType
    {
        $this->args['show_in_admin_bar'] = $arg;
        return $this;
    }

    public function setMenuPosition(int $arg): PostType
    {
        $this->args['menu_position'] = $arg;
        return $this;
    }

    public function setMenuIcon(string $arg): PostType
    {
        $this->args['menu_icon'] = $arg;
        return $this;
    }

    public function setCapabilityType(string $arg): PostType
    {
        $this->args['capability_type'] = $arg;
        return $this;
    }

    public function setMapMetaCap(bool $arg): PostType
    {
        $this->args['map_meta_cap'] = $arg;
        return $this;
    }

    public function setSupports(array $args): PostType
    {
        $this->args['supports'] = $args;
        return $this;
    }

    public function setRegisterMetaBoxCb(callable $func): PostType
    {
        $this->args['register_meta_box_cb'] = $func;
        return $this;
    }

    /**
     * @param string[] $arg
     * @return $this
     */
    public function setTaxonomies(array $arg): PostType
    {
        $this->args['taxonomies'] = $arg;
        return $this;
    }

    public function setHasArchive(bool $arg): PostType
    {
        $this->args['has_archive'] = $arg;
        return $this;
    }

    public function setCanExport(bool $arg): PostType
    {
        $this->args['can_export'] = $arg;
        return $this;
    }

    public function setDeleteWithUser(bool $arg): PostType
    {
        $this->args['delete_with_user'] = $arg;
        return $this;
    }

    public function setTemplate(array $arg): PostType
    {
        $this->args['template'] = $arg;
        return $this;
    }

    public function setTemplateBlock($arg): PostType
    {
        $this->args['template_lock'] = $arg;
        return $this;
    }

    public function register()
    {
        if ( !function_exists('register_post_type') ) {
            return;
        }
        register_post_type($this->key, $this->args);
    }

}
