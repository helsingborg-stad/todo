<?php

namespace TODO;

class Comments
{

    public function __construct()
    {
        add_action('acf/render_field/type=wysiwyg', array($this, 'listComments'), 15, 1);
    }

    /**
     * Removes some meta boxes
     * @return void
     */
    public function listComments($field)
    {
        if ($field['_name'] != "ticket_add_comment") {
            return;
        }

        echo "blaha";
    }
}
