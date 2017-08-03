<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_598181c6ea020',
    'title' => __('Ticket comments', 'todo'),
    'fields' => array(
        0 => array(
            'key' => 'field_598181d048f6a',
            'label' => __('Add new comment', 'todo'),
            'name' => 'ticket_add_comment',
            'type' => 'wysiwyg',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'tabs' => 'visual',
            'toolbar' => 'basic',
            'media_upload' => 0,
        ),
        1 => array(
            'key' => 'field_5982c0ec0f328',
            'label' => __('Files', 'todo'),
            'name' => 'ticket_add_files',
            'type' => 'repeater',
            'instructions' => __('Note: You have to write a note in the "comment" field to submit new files. Otherwise they will be ignored.', 'todo'),
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'collapsed' => '',
            'min' => '',
            'max' => '',
            'layout' => 'table',
            'button_label' => 'Add file',
            'sub_fields' => array(
                0 => array(
                    'key' => 'field_5982c15b0f329',
                    'label' => __(__('Files', 'todo'), 'todo'),
                    'name' => 'ticket_add_files_file',
                    'type' => 'file',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'return_format' => 'array',
                    'library' => 'uploadedTo',
                    'min_size' => '',
                    'max_size' => 20,
                    'mime_types' => '',
                ),
            ),
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