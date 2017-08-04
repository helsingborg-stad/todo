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

        //Force open comments
        add_filter('comments_open', array($this, 'forceOpenComments'), 15, 2);

        //Acf hooks
        add_action('acf/render_field/type=repeater', array($this, 'listComments'), 15, 1);
        add_action('acf/save_post', array($this, 'addComment'), 5, 1);
    }

     /**
     * Force open comments filed on tickets
     * @return void
     */
    public function forceOpenComments($open, $postId)
    {
        if (get_post_type($postId)) {
            return 1;
        }
        return $open;
    }

    /**
     * Show entered comments
     * @return void
     */
    public function listComments($field)
    {
        if ($field['_name'] != "ticket_add_files") {
            return;
        }

        $output = "";

        if (isset($_GET['post']) && is_numeric($_GET['post'])) {
            $previusComments = get_comments(array('post_id' => $_GET['post']));

            if (is_array($previusComments) && !empty($previusComments)) {
                foreach (array_reverse($previusComments) as $comment) {

                    //Gather meta
                    $filesMeta = get_comment_meta($comment->comment_ID, 'ticket_comment_files', true);

                    //Start
                    $output .= '<table class="ticket-comments table widefat fixed">';

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
                    $output .= '<span class="content">' . apply_filters('the_content', $comment->comment_content) . '</span>';
                    $output .= '</td>';
                    $output .= '</tr>';

                    //Files
                    if (is_Array($filesMeta) && !empty($filesMeta)) {
                        $output .= '<tr>';
                        $output .= '<td colspan="2">';
                        foreach ($filesMeta as $fileKey => $file) {
                            if ($fileKey > 0) {
                                $output .= ', ';
                            }
                            $output .= '<a target="_blank" href="' . wp_get_attachment_url($file) . '">' . get_the_title($file) . '</a>';
                        }
                        $output .= '</td>';
                        $output .= '</tr>';
                    }

                    $output .= '</tbody>';

                    //End
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

        //Definitions
        $commentId = null;

        //Bail early if no ACF data
        if (empty($_POST['acf'])) {
            return;
        }

        //Add comment
        if (isset($_POST['acf']['field_598181d048f6a']) && !empty($_POST['acf']['field_598181d048f6a'])) {
            $commentId = wp_new_comment(array(
                'comment_post_ID' => $postId,
                'comment_author' => $this->currentUser->user_firstname . $this->currentUser->user_lastname,
                'comment_author_email' => $this->currentUser->user_email,
                'comment_content' => $_POST['acf']['field_598181d048f6a'],
                'user_id' =>$this->currentUser->user_id,
            ));
        }

        //Append files to comment
        if (!is_null($commentId) && is_numeric($commentId) && isset($_POST['acf']['field_5982c0ec0f328']) && !empty($_POST['acf']['field_5982c0ec0f328'])) {
            $resultArray = array();
            $dataTarget = $_POST['acf']['field_5982c0ec0f328'];

            if (is_array($dataTarget) && !empty($dataTarget)) {
                foreach ($dataTarget as $item) {
                    $resultArray[] = array_pop($item);
                }
            }

            add_comment_meta($commentId, 'ticket_comment_files', $resultArray);
        }

        //Reset value(s)
        unset($_POST['acf']['field_598181d048f6a']);
        unset($_POST['acf']['field_5982c0ec0f328']);
    }
}
