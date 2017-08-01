<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_5805e5dc0a3be',
    'title' => __('Contacts', 'todo'),
    'fields' => array(
        0 => array(
            'key' => 'field_5805e5dc1da44',
            'label' => __('Display mode', 'todo'),
            'name' => 'display_mode',
            'type' => 'select',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'cards' => __('Cards', 'todo'),
                'vertical' => __('Horizontal cards', 'todo'),
                'list' => __('List', 'todo'),
            ),
            'default_value' => array(
                0 => 'cards',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'ajax' => 0,
            'return_format' => 'value',
            'placeholder' => '',
        ),
        1 => array(
            'key' => 'field_5805e5dc1dc55',
            'label' => __('Kontakter', 'todo'),
            'name' => 'contacts',
            'type' => 'flexible_content',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'min' => 1,
            'max' => '',
            'button_label' => 'Add contact',
            'layouts' => array(
                0 => array(
                    'key' => '5757b95767730',
                    'name' => 'custom',
                    'label' => 'Custom',
                    'display' => 'block',
                    'sub_fields' => array(
                        0 => array(
                            'key' => 'field_5805e5dc26dde',
                            'label' => 'Bild',
                            'name' => 'image',
                            'type' => 'image',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'return_format' => 'array',
                            'preview_size' => 'thumbnail',
                            'library' => 'all',
                            'min_width' => '',
                            'min_height' => '',
                            'min_size' => '',
                            'max_width' => '',
                            'max_height' => '',
                            'max_size' => '',
                            'mime_types' => '',
                        ),
                        1 => array(
                            'key' => 'field_5805e5dc27255',
                            'label' => 'Förnamn eller plats',
                            'name' => 'first_name',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '50',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                        ),
                        2 => array(
                            'key' => 'field_5805e5dc276e1',
                            'label' => 'Efternamn',
                            'name' => 'last_name',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '50',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                        ),
                        3 => array(
                            'key' => 'field_5805e5dc2771c',
                            'label' => 'Jobbtitel',
                            'name' => 'work_title',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => 50,
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'readonly' => 0,
                            'disabled' => 0,
                        ),
                        4 => array(
                            'key' => 'field_5805e5dc277e3',
                            'label' => 'Förvaltning',
                            'name' => 'administration_unit',
                            'type' => 'text',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => 50,
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'maxlength' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                            'readonly' => 0,
                            'disabled' => 0,
                        ),
                        5 => array(
                            'key' => 'field_5805e5dc27b58',
                            'label' => 'E-post',
                            'name' => 'email',
                            'type' => 'email',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '100',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'placeholder' => '',
                            'prepend' => '',
                            'append' => '',
                        ),
                        6 => array(
                            'key' => 'field_5805e62f94d0f',
                            'label' => 'Telefonnummer',
                            'name' => 'phone_numbers',
                            'type' => 'repeater',
                            'instructions' => '',
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
                            'button_label' => 'Lägg till nummer',
                            'sub_fields' => array(
                                0 => array(
                                    'key' => 'field_5805e64a94d10',
                                    'label' => 'Telefonnummer',
                                    'name' => 'number',
                                    'type' => 'text',
                                    'instructions' => '',
                                    'required' => 0,
                                    'conditional_logic' => 0,
                                    'wrapper' => array(
                                        'width' => '',
                                        'class' => '',
                                        'id' => '',
                                    ),
                                    'default_value' => '',
                                    'placeholder' => '',
                                    'prepend' => '',
                                    'append' => '',
                                    'maxlength' => '',
                                ),
                            ),
                        ),
                        7 => array(
                            'key' => 'field_5805e5dc28d3a',
                            'label' => 'Adress',
                            'name' => 'address',
                            'type' => 'textarea',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => 50,
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'new_lines' => 'wpautop',
                            'maxlength' => '',
                            'placeholder' => '',
                            'rows' => '',
                            'readonly' => 0,
                            'disabled' => 0,
                        ),
                        8 => array(
                            'key' => 'field_5805e5dc28e30',
                            'label' => 'Besöksadress',
                            'name' => 'visiting_address',
                            'type' => 'textarea',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => 50,
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'new_lines' => 'wpautop',
                            'maxlength' => '',
                            'placeholder' => '',
                            'rows' => '',
                            'readonly' => 0,
                            'disabled' => 0,
                        ),
                        9 => array(
                            'key' => 'field_5805e5dc29114',
                            'label' => 'Öppettider',
                            'name' => 'opening_hours',
                            'type' => 'textarea',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'default_value' => '',
                            'new_lines' => 'wpautop',
                            'maxlength' => '',
                            'placeholder' => '',
                            'rows' => '',
                            'readonly' => 0,
                            'disabled' => 0,
                        ),
                        10 => array(
                            'key' => 'field_5805e5dc29182',
                            'label' => 'Annat',
                            'name' => 'other',
                            'type' => 'wysiwyg',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'tabs' => 'all',
                            'toolbar' => 'full',
                            'media_upload' => 1,
                            'default_value' => '',
                            'delay' => 0,
                        ),
                    ),
                    'min' => '',
                    'max' => '',
                ),
                1 => array(
                    'key' => '5757b97ffecc6',
                    'name' => 'user',
                    'label' => 'User',
                    'display' => 'block',
                    'sub_fields' => array(
                        0 => array(
                            'key' => 'field_5805e5dc291c4',
                            'label' => 'Välj användare',
                            'name' => 'user',
                            'type' => 'user',
                            'instructions' => '',
                            'required' => 1,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'role' => '',
                            'multiple' => 0,
                            'allow_null' => 0,
                        ),
                    ),
                    'min' => '',
                    'max' => '',
                ),
            ),
        ),
        2 => array(
            'key' => 'field_5805e5dc1ddcd',
            'label' => __('Kolumner', 'todo'),
            'name' => 'columns',
            'type' => 'select',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => array(
                0 => array(
                    0 => array(
                        'field' => 'field_5805e5dc1da44',
                        'operator' => '==',
                        'value' => 'cards',
                    ),
                ),
                1 => array(
                    0 => array(
                        'field' => 'field_5805e5dc1da44',
                        'operator' => '==',
                        'value' => 'circular',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'grid-md-12' => __('1', 'todo'),
                'grid-md-6' => __('2', 'todo'),
                'grid-md-4' => __('3', 'todo'),
                'grid-md-3' => __('4', 'todo'),
            ),
            'default_value' => array(
                0 => 'grid-md-12',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'ajax' => 0,
            'return_format' => 'value',
            'placeholder' => '',
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'post',
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