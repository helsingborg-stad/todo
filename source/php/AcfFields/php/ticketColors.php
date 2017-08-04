<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_5982cf5904273',
    'title' => __('Taxonomy color', 'todo'),
    'fields' => array(
        0 => array(
            'key' => 'field_5982cf5f2ac28',
            'label' => __('Taxonomy color', 'todo'),
            'name' => 'taxonomy_color',
            'type' => 'color_picker',
            'instructions' => __('Select a color for this taxonomy to make it stand out.', 'todo'),
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'taxonomy',
                'operator' => '==',
                'value' => 'todo-category',
            ),
        ),
        1 => array(
            0 => array(
                'param' => 'taxonomy',
                'operator' => '==',
                'value' => 'todo-type',
            ),
        ),
        2 => array(
            0 => array(
                'param' => 'taxonomy',
                'operator' => '==',
                'value' => 'todo-priority',
            ),
        ),
        3 => array(
            0 => array(
                'param' => 'taxonomy',
                'operator' => '==',
                'value' => 'todo-status',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
));
}