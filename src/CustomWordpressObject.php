<?php

namespace Copia;

abstract class CustomWordpressObject
{

    /** @var string */
    protected $key;

    /** @var array */
    protected $args;

    /** @var string */
    protected $singular;

    /** @var string */
    protected $plural;

    public function __construct()
    {
        $this->generateSingularPluralFromKey();
        $this->generateLabels();
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getArgs()
    {
        return $this->args;
    }

    public function setLabels(array $args): CustomWordpressObject
    {
        foreach ( $args as $argKey => $argValue ) {
            $this->args['labels'][$argKey] = $argValue;
        }
        return $this;
    }

    public function setDescription(string $arg): CustomWordpressObject
    {
        $this->args['description'] = $arg;
        return $this;
    }

    public function setPublic(bool $arg): CustomWordpressObject
    {
        $this->args['public'] = $arg;
        return $this;
    }

    public function setHierarchical(bool $arg): CustomWordpressObject
    {
        $this->args['hierarchical'] = $arg;
        return $this;
    }

    public function setPubliclyQueryable(bool $arg): CustomWordpressObject
    {
        $this->args['publicly_queryable'] = $arg;
        return $this;
    }

    public function setShowUi(bool $arg): CustomWordpressObject
    {
        $this->args['show_ui'] = $arg;
        return $this;
    }

    public function setShowInMenu(bool $arg): CustomWordpressObject
    {
        $this->args['show_in_menu'] = $arg;
        return $this;
    }

    public function setShowInNavMenus(bool $arg): CustomWordpressObject
    {
        $this->args['show_in_nav_menus'] = $arg;
        return $this;
    }

    public function setShowInRest(bool $arg): CustomWordpressObject
    {
        $this->args['show_in_rest'] = $arg;
        return $this;
    }

    public function setRestBase(string $arg): CustomWordpressObject
    {
        $this->args['rest_base'] = $arg;
        return $this;
    }

    public function setRestNamespace(string $arg): CustomWordpressObject
    {
        $this->args['rest_namespace'] = $arg;
        return $this;
    }

    public function setRestControllerClass(string $arg): CustomWordpressObject
    {
        $this->args['rest_controller_class'] = $arg;
        return $this;
    }

    public function setCapabilities(array $args): CustomWordpressObject
    {
        $this->args['capabilities'] = $args;
        return $this;
    }

    public function setRewrite(bool|array $args): CustomWordpressObject
    {
        $this->args['rewrite'] = $args;
        return $this;
    }

    public function setQueryVar($arg): CustomWordpressObject
    {
        $this->args['query_var'] = $arg;
        return $this;
    }

    /**
     * Attempts to automatically generate labels based on $this->key
     * @return void
     */
    protected function generateSingularPluralFromKey()
    {
        if ( is_null($this->singular) ) {
            $this->singular = ucfirst(preg_replace('/[-_]/', ' ', $this->key));
        }
        if ( is_null($this->plural) ) {
            $this->plural = $this->singular . 's';
        }
    }

    abstract public function register();

    abstract protected function generateLabels();

}
