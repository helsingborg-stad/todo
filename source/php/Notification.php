<?php

namespace TODO;

class Notification
{

    public function __construct()
    {

        //Register manual trigger
        add_filter('acf/load_field/key=field_5981c7635302f', array($this, 'manualTriggerButton'), 10, 3);

        //Show notice
        add_action('admin_notices', array($this, 'showSendMailNotice'));

        //Trigger email
        add_action('admin_notices', function () {
            if (isset($_GET['notification']) && $_GET['notification'] == 'true') {
                $this->sendMail("Ticket title", __("New updates avabile."), $_GET['post']);
            }
        });
    }

    public function showSendMailNotice()
    {
        if (isset($_GET['notification']) && $_GET['notification'] == 'true') {
            echo '<div class="notice notice-success is-dismissible">';
            echo '<p>';
            _e('Status update on this ticket has been sent to the customers registered email adress.', 'todo');
            echo '</p>';
            echo '</div>';
        }
    }

    public function manualTriggerButton($field)
    {
        if (isset($_GET['post']) && is_numeric($_GET['post'])) {

            //Set post id
            $postId = $_GET['post'];

            //Get details
            $lastNotified   = get_post_meta($postId, 'last_notification_email', true);
            $ticketCustomer = get_post_meta($postId, 'ticket_customer', true);

            //Create link
            $sendMailLink = admin_url("post.php" . add_query_arg(array(
                'post'          => $postId,
                'action'        => 'edit',
                'notification'  => 'true',
            )));

            //Validate ticket customer
            if ($ticketCustomer) {
                $field['message'] .= '<a href="' . $sendMailLink . '" class="button button-primary button-large" style="width: 100%; text-align: center; margin-top: 10px;">' . __("Send email", 'todo') . '</a>';

                if ($lastNotified) {
                    $field['message'] .= '<p class="description">' . __("Last noficiation sent at: "). $lastNotified . '</p>';
                }
            } else {
                $field['message'] = __("Please select a customer to enable this feature.", 'todo');
            }
        } else {
            $field['message'] = __("Please save this ticket before trying to send the user a email.", 'todo');
        }

        return $field;
    }

    private function sendMail($ticketTitle, $ticketContent, $ticketId)
    {
        $customer = get_field('ticket_customer', $ticketId);

        if (isset($customer->ID) && is_numeric($customer->ID)) {

            //Gather user id details
            $customerContactDetails = array(
                'userId' => $customerId,
                'userEmail' => $customer->user_email,
                'userName' => $customer->first_name . " " . $customer->last_name
            );

            //Create mail headers
            $ticketMailHeaders = array('Content-Type: text/html; charset=UTF-8','From: Todo Tickets <todo@helsingborg.se>');

            //Send mail
            wp_mail($customerContactDetails['userEmail'], $ticketTitle, $this->makeHtmlEmail($ticketContent, $ticketId), $ticketMailHeaders);
        } else {
            if (defined('WP_DEBUG') && WP_DEBUG) {
                error_log("Todo WordPress plugin: User id is not specified. Cannot fetch customer.");
            }
        }
    }

    private function makeHtmlEmail($ticketContent, $ticketId)
    {

        //Try to fetch template, if not readable. Fallback.
        if (is_readable(TODO_PATH . '/source/html/emailTemplate.html')) {
            $template = file_get_contents(TODO_PATH . '/source/html/emailTemplate.html');
        } else {
            $template = '{{emailcontent}}';
        }

        //Try to fetch template, if not readable. Fallback.
        if (is_readable(TODO_PATH . '/source/html/emailTemplate.html')) {
            $callToAction = file_get_contents(TODO_PATH . '/source/html/callToAction.html');
        } else {
            $callToAction = '<a href="{{emailcalltoactionlink}}">{{emailcalltoactiontext}}</a>';
        }

        //Fetch full arrend
        $ticketTable = $this->makeTicketTable($ticketId);

        //Glue
        $content = $ticketContent . "<br/><br/>" .$ticketTable . "<br/><br/>" .$callToAction;

        //Populate
        $template = str_replace("{{emailcontent}}", $ticketContent, $template);
        $template = str_replace("{{emailcalltoactionlink}}", get_permalink($ticketId), $template);
        $template = str_replace("{{emailcalltoactiontext}}", __("View ticket", 'todo'), $template);

        return $ticketContent;
    }

    private function makeTicketTable($ticketId, $return = "")
    {
        //Define what fields to get
        $fields = array(
            'ticket_priority' => __("Priority", 'todo'),
            'ticket_support_contact' => __("Support contact", 'todo'),
        );

        //Get data and push to html table
        if (is_array($fields) && !empty($fields)) {
            $return .= '<table border="0" cellpadding="0" cellspacing="0"><tbody>';

            foreach ($fields as $fieldKey => $fieldLabel) {
                $fieldData = get_field($fieldKey, $ticketId, true);

                if (is_array($fieldData)) {
                    $fieldData = implode(", ", $fieldData);
                }

                $return .= '<tr><td><strong>' .$fieldLabel. ':</strong> </td><td>' .$fieldData. '</td></tr>';
            }

            $return .= '</tbody></table>';
        }

        //Return table structure
        return  $return;
    }
}
