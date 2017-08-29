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
                $this->sendMail(
                    __("A ticket that you have reported has been updated", 'todo'),
                    __("This is an automated email on a ticket that you have issued. You cannot respond to this email. Below is a complete summary about the tickets current status.", 'todo'),
                    $_GET['post']
                );
            }
        });

        //Add table to ticket frontend
        add_filter('the_content', function ($content) {

            if (!is_admin() && is_single() && get_post_type() == "ticket") {
                return $content . $this->makeTicketTable(get_the_id(), false);
            }

            return $content;
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
                    $field['message'] .= '<p class="description">' . __("Last noficiation sent at: ", 'todo') . " " . $lastNotified . '</p>';
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
        $customers = get_field('ticket_customer', $ticketId);

        // Move single customer array to new array
        if (isset($customers['ID']) && is_numeric($customers['ID'])) {
            $customers = array($customers);
        }

        if (is_array($customers) && !empty($customers)) {
            foreach ($customers as $customer) {
                if (isset($customer['ID']) && is_numeric($customer['ID'])) {
                    //Gather user id details
                    $customerContactDetails = array(
                        'userId' => $customer['ID'],
                        'userEmail' => $customer['user_email'],
                        'userName' => $customer['user_firstname'] . " " . $customer['user_lastname']
                    );

                    //Create mail headers
                    $ticketMailHeaders = array('Content-Type: text/html; charset=UTF-8','From: Todo Tickets <' . get_option('admin_email') . '>');

                    //Send mail
                    $mailSent = wp_mail($customerContactDetails['userEmail'], $ticketTitle, $this->makeHtmlEmail($ticketContent, $ticketId), $ticketMailHeaders);

                    //Note the time
                    if ($mailSent === true) {
                        update_post_meta($ticketId, 'last_notification_email', current_time('mysql'));
                    }
                } else {
                    if (defined('WP_DEBUG') && WP_DEBUG) {
                        error_log("Todo WordPress plugin: User id is not specified. Cannot fetch customer.");
                    }
                }
            }
        }
    }

    private function makeHtmlEmail($ticketContent, $ticketId)
    {

        //Try to fetch template, if not readable. Fallback.
        if (is_readable(TODO_PATH . '/source/html/emailTemplate.html')) {
            $template = file_get_contents(TODO_PATH . '/source/html/emailTemplate.html');
        } else {
            $template = '{{emailtitle}}{{emailcontent}}';
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
        $content = "<small>" . $ticketContent . "</small>" . "<br/><br/>" .$ticketTable . "<br/><br/>" .$callToAction;

        //Populate
        $template = str_replace("{{emailpreheader}}", __("Update regarding", 'todo') . ' "'. get_the_title($ticketId) . '" (#' . $ticketId . ")", $template);
        $template = str_replace("{{emailtitle}}", __("Update regarding", 'todo') . ' "'. get_the_title($ticketId) . '" (#' . $ticketId . ")", $template);
        $template = str_replace("{{emailcontent}}", $content, $template);
        $template = str_replace("{{emailcalltoactionlink}}", get_permalink($ticketId), $template);
        $template = str_replace("{{emailcalltoactiontext}}", __("View ticket & comments", 'todo'), $template);
        $template = str_replace("{{emailnorespond}}", __("You cannot respond to this email.", 'todo'), $template);

        return $template;
    }

    private function makeTicketTable($ticketId, $includePostData = true, $return = "")
    {
        if (get_post_status($ticketId)) {
            $metaData   = get_post_meta($ticketId);
            $postData   = $includePostData ? get_post($ticketId) : null;
            $postTerms  = get_object_taxonomies('ticket');

            //Get data and push to html table

            $return .= '<table border="0" cellpadding="0" cellspacing="0"><tbody>';

            // Description
            if (isset($postData->post_content) && !empty($postData->post_content)) {
                $return .=
                '<tr><td style="width: 30%;">
                    <strong>' . __("Ticket description", 'todo') . ':</strong> </td>
                    <td>' . apply_filters('the_content', $postData->post_content) . '</td>
                </tr>
                ';
            }

            // The date
            if (isset($postData->post_date) && !empty($postData->post_date)) {
                $return .=
                '<tr><td style="width: 30%;">
                    <strong>' . __("Ticket issued at", 'todo') . ':</strong> </td>
                    <td>' . $postData->post_date . '</td>
                </tr>
                ';
            }

            // Contact
            if (get_field('ticket_support_contact')) {
                $return .=
                '<tr><td style="width: 30%;">
                    <strong>' . __("Support contact", 'todo') . ':</strong> </td>
                    <td>' . get_field('ticket_support_contact')['user_firstname'] . " " . get_field('ticket_support_contact')['user_lastname'] . ' (' . get_field('ticket_support_contact')['user_email'] . ')</td>
                </tr>
                ';
            }

            //Terms
            if (is_array($postTerms) && !empty($postTerms)) {
                foreach ($postTerms as $termKey) {
                    $termData = get_the_terms($ticketId, $termKey);
                    $taxonomyData = get_taxonomy($termKey);

                    if (!empty($termData)) {
                        $return .= '<tr>';
                        $return .= '<td style="width: 30%;"><strong>' . $taxonomyData->label . ':</strong></td>';
                        $return .= '<td>';

                        foreach ((array)$termData as $termKey => $termItem) {
                            if ($termKey > 0) {
                                $return .= ', ';
                            }
                            $return .= isset($termItem->name) ? $termItem->name : '-';
                        }

                        $return .= '</td>';
                        $return .= '</tr>';
                    }
                }
            }

            $return .= '</tbody></table>';
        }

        //Return table structure
        return  $return;
    }
}
