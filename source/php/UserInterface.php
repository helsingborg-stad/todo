<?php

namespace TODO;

class UserInterface
{
    public $post_type = 'ticket';

    public function __construct()
    {
        add_action('do_meta_boxes', array($this, 'unregisterComponents'));
        add_filter('page_attributes_dropdown_pages_args', array($this, 'limitPostTypeHierarchy'));
        add_filter('quick_edit_dropdown_pages_args', array($this, 'limitPostTypeHierarchy'));
        add_filter('BetterPostUi/PageAttributes/EnabledPostTypes', array($this, 'enablePostType'));
    }

    /**
     * Limit ticket hierarchy to two levels.
     * @param  array  $args    the value of the field by definition
     * @return array           updated $args
     */
    public function limitPostTypeHierarchy($args)
    {
        global $post, $post_type_object;

        if ($post_type_object->name == $this->post_type && is_array($args)) {
            $args['depth'] = 1;

            if (count(get_children($post->ID)) > 0) {
                $args['include'] = array(0);
            }
        }

        return $args;
    }

    /**
     * Removes some meta boxes
     * @return void
     */
    public function unregisterComponents()
    {
        global $post;
        $components = array('acf-group_56c33cf1470dc', 'acf-group_56d83cff12bb3');

        // Remove Sprint meta box from parent pages
        if (is_object($post) && !$post->post_parent) {
            $components[] = 'todo-sprintdiv';
        }

        foreach ($components as $component) {
            remove_meta_box($component, $this->post_type, 'side');
        }
    }

    /**
     * Add page attribute meta box for tickets
     * @param  array $post_types List of enabled post types
     * @return array             Modified list
     */
    public function enablePostType($post_types)
    {
        $post_types[] = $this->post_type;
        return $post_types;
    }
}
