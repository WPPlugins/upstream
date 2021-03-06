<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;



class Upstream_Counts {

    // private $columns = array();
    public $projects = null;
    public $user = null;


    /** Class constructor */
    public function __construct( $id ) {
        $this->projects = $this->get_projects( $id );
        $this->user = upstream_user_data();
    }

    /**
     * Retrieve all tasks from projects.
     *
     * @return array
     */
    public function get_projects( $id ) {
        $args = array(
            'post_type'         => 'project',
            'post_status'       => 'publish',
            'posts_per_page'    => -1
        );

        if ((int)$id > 0) {
            $args['include'] = $id;
        }

        $projects = get_posts( $args );
        if ( $projects )
            return $projects;
    }

    /**
     * Retrieve all items from projects.
     *
     * @return array
     */
    public function get_items( $type ) {
        if( ! $this->projects )
            return;
        $items = array();
        foreach ( $this->projects as $i => $project ) {
            $meta = get_post_meta( $project->ID, '_upstream_project_' . $type, true );
            if( $meta && is_array( $meta ) ) {
                foreach ($meta as $key => $value) {
                    array_push($items, $value);
                }
            }

        };
        return $items;
    }

    /**
     * Get the count of items.
     *
     */
    public function total( $type ) {
        return count( $this->get_items( $type ) );
    }

    /**
     * Returns the total count of open items
     *
     * @return null|int
     */
    public function total_open( $type ) {
        $items = $this->get_items( $type );
        if( ! $items )
            return '0';

        $option     = get_option( 'upstream_' . $type );
        $statuses   = isset( $option['statuses'] ) ? $option['statuses'] : '';

        if( ! $statuses ) {
            if( $type == 'milestones' ) {
                return $this->total( $type );
            } else {
                return null;
            }
        }

        $types = wp_list_pluck( $statuses, 'type', 'name' );

        $count = 0;
        foreach ($items as $key => $item) {
            if( !isset( $item['status'] ) )
                continue;
            $item_status = $item['status'];
            if( isset( $types[$item_status] ) && $types[$item_status] == 'open' )
                $count += 1;
        }

        return $count;
    }

    /**
     * Get the count of items assigned to the current user.
     *
     * @since   1.0.0
     *
     * @param   string  $itemType The item type to be searched. I.e.: tasks, bugs, etc.
     *
     * @return  integer
     */
    public function assigned_to($itemType)
    {
        $rowset = $this->get_items($itemType);
        if (count($rowset) === 0) {
            return 0;
        }

        $currentUserId = (int)$this->user['id'];

        $assignedItemsCount = 0;

        foreach ($rowset as $row) {
            if (isset($row['assigned_to']) && (int)$row['assigned_to'] === $currentUserId) {
                $assignedItemsCount++;
            }
        }

        return $assignedItemsCount;
    }

    /**
     * Returns the count of OPEN tasks for the current user
     *
     * @return array
     */
    public function assigned_to_open( $type ) {
        $items = $this->get_items( $type );
        if( ! $items )
            return '0';

        $option     = get_option( 'upstream_' . $type );
        $statuses   = isset( $option['statuses'] ) ? $option['statuses'] : '';

        if( ! $statuses ) {
            if( $type == 'milestones' ) {
                return $this->total( $type );
            } else {
                return null;
            }
        }

        $types = wp_list_pluck( $statuses, 'type', 'name' );

        $count = 0;
        foreach ($items as $key => $item) {
            if( ! isset( $item['assigned_to'] ) )
                continue;
            if( $item['assigned_to'] != $this->user['id'] )
                continue;
            $item_status = isset( $item['status'] ) ? $item['status'] : '';

            if( (isset( $types[$item_status] ) && $types[$item_status] == 'open') || $item_status === "" )
                $count += 1;
        }

        return $count;
    }


}


// new Upstream_Counts();
