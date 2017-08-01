<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_59808ae3b4d31',
    'title' => __('Status', 'todo'),
    'fields' => array(
        0 => array(
            'key' => 'field_59808ae8f3d6b',
            'label' => __('Ticket status', 'todo'),
            'name' => 'ticket_status',
            'type' => 'radio',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => 'ticket-status',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'pending' => __('To do / Pending', 'todo'),
                'doing' => __('Doing', 'todo'),
                'done' => __('Done / Closed', 'todo'),
            ),
            'allow_null' => 0,
            'other_choice' => 0,
            'save_other_choice' => 0,
            'default_value' => 'pending',
            'layout' => 'vertical',
            'return_format' => 'value',
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
    'position' => 'side',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => 1,
    'description' => '',
));
}