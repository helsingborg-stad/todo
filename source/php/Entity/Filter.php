<?php

namespace TODO\Entity;

class Filter
{
    public $taxonomySlug;
    public $postType;

    public function __construct($taxonomySlug, $postType)
    {
        $this->taxonomySlug = $taxonomySlug;
        $this->postType = $postType;

        //Add filters
        add_filter('parse_query', array($this, 'addQueryVar'));
        add_action('restrict_manage_posts', array($this, 'graphicSelect'));
    }

    public function graphicSelect()
    {
        global $typenow;

        if ($typenow == $this->postType) {
            wp_dropdown_categories(array(
                'show_option_all' => __("Show All", "todo") . " " . get_taxonomy($this->taxonomySlug)->label,
                'taxonomy'        => $this->taxonomySlug,
                'name'            => $this->taxonomySlug,
                'orderby'         => 'name',
                'selected'        => isset($_GET[$this->taxonomySlug]) ? $_GET[$this->taxonomySlug] : '',
                'show_count'      => true,
                'hide_empty'      => true,
            ));
        };
    }

    /**
     * Filter posts by taxonomy in admin
     * @author  Mike Hemberger
     * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
     */

    public function addQueryVar($query)
    {
        //Gather data
        global $pagenow;
        $q_vars    = &$query->query_vars;

        //Validate that we are on cirrect page
        if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $this->postType && isset($q_vars[$this->taxonomySlug]) && is_numeric($q_vars[$this->taxonomySlug]) && $q_vars[$this->taxonomySlug] != 0) {
            $term = get_term_by('id', $q_vars[$this->taxonomySlug], $this->taxonomySlug);
            $q_vars[$this->taxonomySlug] = $term->slug;
        }

        return $query;
    }
}
