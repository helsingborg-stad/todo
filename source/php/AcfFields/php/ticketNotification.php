<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_5981c75a143dc',
    'title' => __('Update customer', 'todo'),
    'fields' => array(
        0 => array(
            'key' => 'field_5981c7635302f',
            'label' => __('Send update email', 'todo'),
            'name' => '',
            'type' => 'message',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'message' => __('Manually send an update to the customer about this arrend. The customer will get a link to the arrend and a summary by email.Please save this ticket before trying to send the user a email.', 'todo'),
            'new_lines' => 'wpautop',
            'esc_html' => 0,
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