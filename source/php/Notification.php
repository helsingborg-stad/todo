<?php

namespace TODO;

class Notification
{

    public function __construct()
    {
        /*add_action('publish_ticket', array($this, 'registeredTicket'), 10, 2);
        add_action('unpublish_ticket', array($this, 'pendingApproval'), 10, 2);
        add_action('delete_ticket', array($this, 'unpublish'));
        add_action('delete_ticket', array($this, 'unpublish'));*/
    }

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

    private function sendMail($tickedId)
    {

        $customerId = get_post_meta($tickedId, 'ticket_customer_id', true);

        if (is_numeric($customerId)) {

            $customerData = get_user_by($customerId);


            $customerContactDetails = array(
            'userId' => $customerId,
            'userEmail' => get_user_by($customerId);
        );


        } else {
            if (defined('WP_DEBUG') && WP_DEBUG) {
                error_log("Todo WordPress plugin: User id does not exist. Cannot fetch customer.");
            }
        }

        $customerContactDetails = array(
            'userId' => $customerId,
            'userEmail' => get_user_by($customerId);
        );

        //wp_mail( $to, $subject, $message, $headers, $attachments );
    }
}
