<?php

namespace TODO;

class Comments
{

    private $currentUser;

    public function __construct()
    {
        //Not enabled for unathenticated users
        if (!is_user_logged_in()) {
            return;
        }

        //Get current user data
        add_action('admin_init', function () {
            $this->currentUser = wp_get_current_user();
        });

        //Acf hooks
        add_action('acf/render_field/type=wysiwyg', array($this, 'listComments'), 15, 1);
        add_action('acf/save_post', array($this, 'addComment'), 5, 1);
    }

    /**
     * Sshow entered comments
     * @return void
     */
    public function listComments($field)
    {
        if ($field['_name'] != "ticket_add_comment") {
            return;
        }

        $output = "";

        if (isset($_GET['post']) && is_numeric($_GET['post'])) {
            $previusComments = get_comments(array('post_ID' => $_GET['post']));

            if (is_array($previusComments) && !empty($previusComments)) {
                foreach (array_reverse($previusComments) as $comment) {
                    $output .= '<table class="ticket-comments table widefat fixed" style="margin-top: 20px;">';

                    //Header
                    $output .= '<thead>';
                    $output .= '<tr>';
                    $output .= '<th class="manage-column"><strong>' .$comment->comment_author. '</strong></th>';
                    $output .= '<th class="manage-column">' .$comment->comment_date. '</th>';
                    $output .= '</tr>';
                    $output .= '</thead>';

                    //Content
                    $output .= '<tbody>';

                    $output .= '<tr class="alternate">';
                    $output .= '<td colspan="2">';
                    $output .= '<span class="content">' .$comment->comment_content. '</span>';
                    $output .= '</td>';
                    $output .= '</tr>';

                    $output .= '</tbody>';
                    $output .= '</table>';
                }
            }
        }

        echo $output;
    }

    /**
     * Add new comment
     * @return void
     */
    public function addComment($postId)
    {

        //Bail early if no ACF data
        if (empty($_POST['acf'])) {
            return;
        }

        //Add comment
        if (isset($_POST['acf']['field_598181d048f6a']) && !empty($_POST['acf']['field_598181d048f6a'])) {
            $comment_id = wp_new_comment(array(
                'comment_post_ID' => $postId,
                'comment_author' => $this->currentUser->user_firstname . $this->currentUser->user_lastname,
                'comment_author_email' => $this->currentUser->user_email,
                'comment_content' => $_POST['acf']['field_598181d048f6a'],
                'user_id' =>$this->currentUser->user_id,
            ));
        }

        //Reset value
        $_POST['acf']['field_598181d048f6a'] = "";
    }
}
