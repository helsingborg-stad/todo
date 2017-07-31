<?php

namespace TODO\Entity;

class PostType
{
    public $namePlural;
    public $nameSingular;
    public $slug;
    public $args;

    public $tableColumns = array();
    public $tableSortableColumns = array();
    public $tableColumnsContentCallback = array();

    /**
     * Registers a custom post type
     * @param string $namePlural
     * @param string $nameSingular
     * @param string $slug
     * @param array  $args
     */
    public function __construct($namePlural, $nameSingular, $slug, $args = array())
    {
        $this->namePlural = $namePlural;
        $this->nameSingular = $nameSingular;
        $this->slug = $slug;
        $this->args = $args;

        // Register post type
        add_action('init', array($this, 'registerPostType'));

        // Handle list table columns
        add_filter('manage_edit-' . $this->slug . '_columns', array($this, 'tableColumns'));
        add_filter('manage_edit-' . $this->slug . '_sortable_columns', array($this, 'tableSortableColumns'));
        add_action('manage_' . $this->slug . '_posts_custom_column', array($this, 'tableColumnsContent'), 10, 2);
    }

    /**
     * Register the actual post type
     * @return string Registered post type slug
     */
    public function registerPostType() : string
    {
        $labels = array(
            'name'                => $this->namePlural,
            'singular_name'       => $this->nameSingular,
            'add_new'             => sprintf(__('Add new %s', 'todo'), $this->nameSingular),
            'add_new_item'        => sprintf(__('Add new %s', 'todo'), $this->nameSingular),
            'edit_item'           => sprintf(__('Edit %s', 'todo'), $this->nameSingular),
            'new_item'            => sprintf(__('New %s', 'todo'), $this->nameSingular),
            'view_item'           => sprintf(__('View %s', 'todo'), $this->nameSingular),
            'search_items'        => sprintf(__('Search %s', 'todo'), $this->namePlural),
            'not_found'           => sprintf(__('No %s found', 'todo'), $this->namePlural),
            'not_found_in_trash'  => sprintf(__('No %s found in trash', 'todo'), $this->namePlural),
            'parent_item_colon'   => sprintf(__('Parent %s:', 'todo'), $this->nameSingular),
            'menu_name'           => $this->namePlural,
        );

        $this->args['labels'] = $labels;

        register_post_type($this->slug, $this->args);

        return $this->slug;
    }

    /**
     * Adds a column to the admin list table
     * @param string   $key             Column key
     * @param string   $title           Column title
     * @param boolean  $sortable        Sortable or not
     * @param callback $contentCallback Callback function for displaying
     *                                  column content (params: $columnKey, $postId)
     */
    public function addTableColumn($key, $title, $sortable = false, $contentCallback = false) : bool
    {
        $this->tableColumns[$key] = $title;

        if ($sortable === true) {
            $this->tableSortableColumns[$key] = $key;
        }

        if ($contentCallback !== false) {
            $this->tableColumnsContentCallback[$key] = $contentCallback;
        }

        return true;
    }

    /**
     * Set up table columns
     * @param  array $columns Default columns
     * @return array          New columns
     */
    public function tableColumns($columns) : array
    {
        if (!empty($this->tableColumns) && is_array($this->tableColumns)) {
            $columns = array_merge(
                array_splice($columns, 0, 2),
                $this->tableColumns,
                array_splice($columns, 0, count($columns))
            );
        }

        return $columns;
    }

    /**
     * Setup sortable columns
     * @param  array $columns Default columns
     * @return array          New columns
     */
    public function tableSortableColumns($columns) : array
    {
        if (!empty($this->tableSortableColumns) && is_array($this->tableSortableColumns)) {
            $columns = $this->tableColumns;
        }

        return unserialize(strtolower(serialize($columns)));
    }

    /**
     * Set table column content with callback functions
     * @param  string  $column Key of the column
     * @param  integer $postId Post id of the current row in table
     * @return void
     */
    public function tableColumnsContent($column, $postId)
    {
        if (!isset($this->tableColumnsContentCallback[$column])) {
            return;
        }

        call_user_func_array($this->tableColumnsContentCallback[$column], array($column, $postId));
    }
}
