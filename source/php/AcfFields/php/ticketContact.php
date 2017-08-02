<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_598032ea68406',
    'title' => __('Contact information', 'todo'),
    'fields' => array(
        0 => array(
            'key' => 'field_598032f02a342',
            'label' => __('Reporting customer', 'todo'),
            'name' => 'ticket_customer',
            'type' => 'user',
            'instructions' => __('Select the person who reported this issue or who should be notified about updates about this ticket.', 'todo'),
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'role' => '',
            'allow_null' => 1,
            'multiple' => 0,
        ),
        1 => array(
            'key' => 'field_598033942a343',
            'label' => __('Support contact', 'todo'),
            'name' => 'ticket_support_contact',
            'type' => 'user',
            'instructions' => __('The person who are in chare of getting this task done at the moment.', 'todo'),
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'role' => array(
                0 => 'administrator',
                1 => 'editor',
                2 => 'author',
            ),
            'allow_null' => 1,
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
    'instruction_placement' => 'field',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
));
}