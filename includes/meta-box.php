<?php  
add_filter( 'rwmb_meta_boxes', 'player_results' );

function player_results( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'        => __( 'BB Season Results', 'your-text-domain' ),
        'id'           => 'bb-season-results',
        'post_types'   => ['bigbrother-players'],
        'storage_type' => 'custom_table',
        'table'        => 'wp_bbj_player_results_new',
        'fields'       => [
            [
                'name'              => __( 'BB Seasons Played', 'your-text-domain' ),
                'id'                => $prefix . 'bb_seasons_played',
                'type'              => 'group',
                'clone'             => true,
                'clone_as_multiple' => true,
                'fields'            => [
                    [
                        'name'      => __( 'Season', 'your-text-domain' ),
                        'id'        => $prefix . 'pick_seasons',
                        'type'      => 'post',
                        'post_type' => ['bigbrother-seasons'],
                        'columns'   => 6,
                    ],
                    [
                        'name'    => __( 'Evicted Date', 'your-text-domain' ),
                        'id'      => $prefix . 'evicted_date',
                        'type'    => 'date',
                        'columns' => 6,
                    ],
                ],
            ],
        ],
    ];

    return $meta_boxes;
}