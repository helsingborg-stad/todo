<?php

namespace TODO;

class Notification
{

    public function __construct()
    {

        //Register manual trigger
        //add_action('acf/render_field/type=message', array($this, 'manualTriggerMetabox'), 15, 1);
        add_filter('acf/load_field/key=field_5981c7635302f', array($this, 'manualTriggerButton'), 10, 3);


// array($this, 'registerManualTriggerMetabox'));
        /*add_action('publish_ticket', array($this, 'registeredTicket'), 10, 2);
        add_action('unpublish_ticket', array($this, 'pendingApproval'), 10, 2);
        add_action('delete_ticket', array($this, 'unpublish'));
        add_action('delete_ticket', array($this, 'unpublish'));*/
    }

    public function manualTriggerButton($field)
    {
        if (isset($_GET['post']) && is_numeric($_GET['post'])) {

            //Set post id
            $postId = $_GET['post'];

            //Get details
            $lastNotified = get_post_meta($postId, 'last_notification_email', true);
            $ticketCustomer = get_post_meta($postId, 'ticket_customer', true);

            //Validate ticket customer
            if ($ticketCustomer) {
                $field['message'] .= '<a href="#update" class="button button-primary button-large" style="width: 100%; text-align: center; margin-top: 10px;">' . __("Send email", 'todo') . '</a>';

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
/*

    public function ticketOpened($ticketId)
    {
        $this->sendMail(__("Ticket %s created", 'todo'), __("Your ticket has been approved. You will get a notification when it is done.", 'todo'), $ticketId);
    }

    public function ticketPending($ticketId)
    {
        $this->sendMail(__("Ticket %s pending", 'todo'), __("Your ticket has been created and waiting for administrator approval and classification.", 'todo'), $ticketId);
    }

    public function ticketPriority($ticketId)
    {
        $this->sendMail(__("Ticket %s updated", 'todo'), __("Your ticked have a new priority status.", 'todo'), $ticketId);
    }

    public function ticketComment($ticketId)
    {
        $this->sendMail(__("Ticket %s updated", 'todo'), __("Your ticked have a new comment.", 'todo'), $ticketId);
    }

    private function sendMail($ticketTitle, $ticketContent, $ticketId)
    {
        $customerId = get_post_meta($ticketId, 'ticket_customer_id', true);

        if (is_numeric($customerId)) {

            //Gather user id details
            $customerData = get_user_by($customerId);
            $customerContactDetails = array(
                'userId' => $customerId,
                'userEmail' => $customerData->user_email,
                'userName' => $customerData->first_name . " " . $customerData->last_name
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

    */

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
