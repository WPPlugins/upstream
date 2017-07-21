<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;



function upstream_project_status( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_meta( 'status' );
    return apply_filters( 'upstream_project_status', $result, $id );
}
function upstream_project_statuses_colors() {
    $option     = get_option( 'upstream_projects' );
    $colors     = wp_list_pluck( $option['statuses'], 'color', 'name' );
    return apply_filters( 'upstream_project_statuses_colors', $colors );
}
function upstream_project_status_color( $id = 0 ) {
    $status = upstream_project_status( $id );
    $colors = upstream_project_statuses_colors();
    $color  = isset( $colors[$status] ) ? $colors[$status] : '#aaaaaa';
    $result = array( 'status' => $status, 'color' => $color );
    return apply_filters( 'upstream_project_status_color', $result );
}
function upstream_project_status_type( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_project_status_type();
    return apply_filters( 'upstream_project_status_type', $result );
}

function upstream_project_progress( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_meta( 'progress' );
    $result     = $result ? $result : '0';
    return apply_filters( 'upstream_project_progress', $result, $id );
}

function upstream_project_owner_id( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_meta( 'owner' );
    return apply_filters( 'upstream_project_owner_id', $result, $id );
}

function upstream_project_owner_name( $id = 0, $show_email = false ) {
    $project    = new UpStream_Project( $id );
    $owner_id   = $project->get_meta( 'owner' );
    $result     = $owner_id ? upstream_users_name( $owner_id, $show_email ) : null;
    return apply_filters( 'upstream_project_owner_name', $result, $id, $show_email );
}

function upstream_project_client_id( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_meta( 'client' );
    return apply_filters( 'upstream_project_client_id', $result, $id );
}

function upstream_project_client_name( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_client_name();
    return apply_filters( 'upstream_project_client_name', $result, $id );
}

function upstream_project_client_users( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_meta( 'client_users' );
    return apply_filters( 'upstream_project_client_users', $result, $id );
}

function upstream_project_members_ids( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_meta( 'members' );
    return apply_filters( 'upstream_project_members_ids', $result, $id );
}
// only get WP users
function upstream_project_users( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_meta( 'members' );
    $result     = isset( $result ) ? array_filter( $result , 'is_numeric' ) : '';
    return apply_filters( 'upstream_project_users', $result, $id );
}

function upstream_project_start_date( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_meta( 'start' );
    return apply_filters( 'upstream_project_start_date', $result, $id );
}

function upstream_project_end_date( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_meta( 'end' );
    return apply_filters( 'upstream_project_end_date', $result, $id );
}


function upstream_project_files( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_meta( 'files' );
    return apply_filters( 'upstream_project_files', $result, $id );
}

function upstream_project_description($projectId = 0)
{
    $project = new UpStream_Project((int)$projectId);
    $result = $project->get_meta('description');

    return apply_filters('upstream_project_description', $result, $projectId);
}

function upstream_project_discussion( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_meta( 'discussion' );
    return apply_filters( 'upstream_project_discussion', $result, $id );
}

/* ------------ MILESTONES -------------- */

function upstream_project_milestones( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_meta( 'milestones' );
    return apply_filters( 'upstream_project_milestones', $result, $id );
}

function upstream_project_milestone_by_id( $id = 0, $milestone_id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_item_by_id( $milestone_id, 'milestones' );
    return apply_filters( 'upstream_project_milestone_by_id', $result, $id, $milestone_id );
}
function upstream_project_milestone_colors() {
    $option     = get_option( 'upstream_milestones' );
    $colors     = wp_list_pluck( $option['milestones'], 'color', 'title' );
    return apply_filters( 'upstream_project_milestone_colors', $colors );
}
/* ------------ TASKS -------------- */

function upstream_project_tasks( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_meta( 'tasks' );
    return apply_filters( 'upstream_project_tasks', $result, $id );
}

function upstream_project_task_by_id( $id = 0, $task_id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_item_by_id( $task_id, 'tasks' );
    return apply_filters( 'upstream_project_task_by_id', $result, $id, $task_id );
}

function upstream_project_tasks_counts( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_statuses_counts( 'tasks' );
    return apply_filters( 'upstream_project_tasks_statuses_counts', $result, $id );
}

function upstream_project_task_statuses_colors() {
    $option     = get_option( 'upstream_tasks' );
    $colors     = wp_list_pluck( $option['statuses'], 'color', 'name' );
    return apply_filters( 'upstream_project_tasks_statuses_colors', $colors );
}
function upstream_project_task_status_color( $id = 0, $item_id ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_item_colors( $item_id, 'tasks', 'status' );
    return apply_filters( 'upstream_project_task_status_color', $result );
}

/* ------------ BUGS -------------- */

function upstream_project_bugs( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_meta( 'bugs' );
    return apply_filters( 'upstream_project_bugs', $result, $id );
}

function upstream_project_bug_by_id( $id = 0, $bug_id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_item_by_id( $bug_id, 'bugs' );
    return apply_filters( 'upstream_project_bug_by_id', $result, $id, $bug_id );
}

function upstream_project_bugs_counts( $id = 0 ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_statuses_counts( 'bugs' );
    return apply_filters( 'upstream_project_bugs_statuses_counts', $result, $id );
}

function upstream_project_bug_statuses_colors() {
    $option     = get_option( 'upstream_bugs' );
    $colors     = wp_list_pluck( $option['statuses'], 'color', 'name' );
    return apply_filters( 'upstream_project_bugs_statuses_colors', $colors );
}

function upstream_project_bug_severity_colors() {
    $option     = get_option( 'upstream_bugs' );
    $colors     = wp_list_pluck( $option['severities'], 'color', 'name' );
    return apply_filters( 'upstream_project_bugs_severity_colors', $colors );
}

function upstream_project_bug_status_color( $id = 0, $item_id ) {
    $project    = new UpStream_Project( $id );
    $result     = $project->get_item_colors( $item_id, 'bugs', 'status' );
    return apply_filters( 'upstream_project_bug_status_color', $result );
}


function upstream_project_item_by_id( $id = 0, $item_id = 0 ) {
    $project = new UpStream_Project( $id );
    $result = $project->get_item_by_id( $item_id, 'milestones' );
    if( ! $result )
        $result = $project->get_item_by_id( $item_id, 'tasks' );
    if( ! $result )
        $result = $project->get_item_by_id( $item_id, 'bugs' );
    if( ! $result )
        $result = $project->get_item_by_id( $item_id, 'files' );
    if( ! $result )
        $result = $project->get_item_by_id( $item_id, 'discussion' );
    return apply_filters( 'upstream_project_item_by_id', $result, $id, $item_id );
}

/* ------------ COUNTS -------------- */


/**
 * Get the count of items for a type.
 *
 * @param type | string type of item such as bug, task etc
 * @param id | int id of the project you want the count for
 */
function upstream_count_total( $type, $id = 0 ) {
    if( ! $id && is_admin() ) {
        $id = isset( $_GET['post'] ) ? $_GET['post'] : 'n/a';
    }

    $count = new Upstream_Counts( $id );
    return $count->total( $type );
}

/**
 * Get the count of OPEN items for a type.
 *
 * @param type | string type of item such as bug, task etc
 * @param id | int id of the project you want the count for
 */
function upstream_count_total_open( $type, $id = 0 ) {
    $count = new Upstream_Counts( $id );
    return $count->total_open( $type );
}

/**
 * Get the count of items for a type that is assigned to current user.
 *
 * @param type | string type of item such as bug, task etc
 * @param id | int id of the project you want the count for
 */
function upstream_count_assigned_to( $type, $id = 0 ) {
    $count = new Upstream_Counts( $id );
    return $count->assigned_to( $type );
}

/**
 * Get the count of OPEN items for a type that is assigned to current user.
 *
 * @param type | string type of item such as bug, task etc
 * @param id | int id of the project you want the count for
 */
function upstream_count_assigned_to_open( $type, $id = 0 ) {
    $count = new Upstream_Counts( $id );
    return $count->assigned_to_open( $type );
}
