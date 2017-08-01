<?php

namespace TODO;

class UserInterface
{

    public function __construct()
    {
        add_action('admin_menu', function () {
            $this->unregisterComponents(array(
                'pageparentdiv',
                'acf-group_56c33cf1470dc',
                'acf-group_56d83cff12bb3'
            ));
        });
    }

    /**
     * Removes some meta boxes
     * @return void
     */
    public function unregisterComponents($components) : bool
    {
        $result = false;
        if (is_array($components) && !empty($components)) {
            foreach ($components as $component) {
                remove_meta_box($component, 'ticket', 'side');
                $result = true;
            }
        }
        return $result;
    }
}
