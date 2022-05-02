<?php
add_filter( 'rwmb_meta_boxes', 'bbj_players' );

function bbj_players( $meta_boxes ) {
    $prefix = '';

    $meta_boxes[] = [
        'title'        => __( 'BB Players', 'your-text-domain' ),
        'id'           => 'bb-players',
        'post_types'   => ['bigbrother-players'],
        'storage_type' => 'custom_table',
        'table'        => 'wp_bbj_players',
        'fields'       => [
            [
                'name' => __( 'First Name', 'your-text-domain' ),
                'id'   => $prefix . 'first_name',
                'type' => 'text',
            ],
            [
                'name' => __( 'Last Name', 'your-text-domain' ),
                'id'   => $prefix . 'last_name',
                'type' => 'text',
            ],
            [
                'name' => __( 'Official Nickname', 'your-text-domain' ),
                'id'   => $prefix . 'official_nickname',
                'type' => 'text',
            ],
            [
                'name' => __( 'Right Side', 'your-text-domain' ),
                'id'   => $prefix . 'right_side',
                'type' => 'wysiwyg',
            ],
            [
                'name'    => __( 'Profile Picture', 'your-text-domain' ),
                'id'      => $prefix . 'profile_picture',
                'type'    => 'single_image',
                'columns' => 4,
            ],
            [
                'name'    => __( 'Player Banner', 'your-text-domain' ),
                'id'      => $prefix . 'player_banner',
                'type'    => 'single_image',
                'columns' => 4,
            ],
            [
                'name'    => __( 'Date of birth', 'your-text-domain' ),
                'id'      => $prefix . 'date_of_birth',
                'type'    => 'date',
                'columns' => 6,
            ],
            [
                'name'    => __( 'Occupation', 'your-text-domain' ),
                'id'      => $prefix . 'occupation',
                'type'    => 'text',
                'columns' => 6,
            ],
            [
                'name'    => __( 'Facebook', 'your-text-domain' ),
                'id'      => $prefix . 'facebook',
                'type'    => 'url',
                'columns' => 3,
            ],
            [
                'name'    => __( 'Instagram', 'your-text-domain' ),
                'id'      => $prefix . 'instagram',
                'type'    => 'url',
                'columns' => 3,
            ],
            [
                'name'    => __( 'Twitter', 'your-text-domain' ),
                'id'      => $prefix . 'twitter',
                'type'    => 'url',
                'columns' => 3,
            ],
            [
                'name'    => __( 'Tiktok', 'your-text-domain' ),
                'id'      => $prefix . 'tiktok',
                'type'    => 'url',
                'columns' => 3,
            ],
        ],
    ];

    return $meta_boxes;
}