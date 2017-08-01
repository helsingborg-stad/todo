<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_59802f5e1d297',
    'title' => __('Priority', 'todo'),
    'fields' => array(
        0 => array(
            'key' => 'field_59803130fba89',
            'label' => __('Priority level', 'todo'),
            'name' => 'ticket_priority',
            'type' => 'taxonomy',
            'instructions' => __('Select a priority level for this ticket.', 'todo'),
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => 'todo-priority',
                'id' => '',
            ),
            'taxonomy' => 'todo-priority',
            'field_type' => 'radio',
            'allow_null' => 0,
            'add_term' => 0,
            'save_terms' => 1,
            'load_terms' => 0,
            'return_format' => 'id',
            'multiple' => 0,
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'ticket',
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