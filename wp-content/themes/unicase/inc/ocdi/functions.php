<?php

function unicase_ocdi_import_files() {
    return apply_filters( 'unicase_ocdi_files_args', array(
        array(
            'import_file_name'             => 'Unicase-v1',
            'categories'                   => array( 'Electronics' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'assets/dummy-data/v1/dummy-data.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'assets/dummy-data/v1/widgets.wie',
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'assets/dummy-data/v1/redux-options.json',
                    'option_name' => 'unicase_options',
                ),
            ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'assets/images/unicase-v1-preview.jpg',
            'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'unicase' ),
            'preview_url'                  => 'https://demo2.chethemes.com/unicase-v1/',
        ),
        array(
            'import_file_name'             => 'Unicase-v2',
            'categories'                   => array( 'Electronics' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'assets/dummy-data/v2/dummy-data.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'assets/dummy-data/v2/widgets.wie',
            'local_import_redux'           => array(
                array(
                    'file_path'   => trailingslashit( get_template_directory() ) . 'assets/dummy-data/v2/redux-options.json',
                    'option_name' => 'unicase_options',
                ),
            ),
            'import_preview_image_url'     => trailingslashit( get_template_directory_uri() ) . 'assets/images/unicase-v2-preview.jpg',
            'import_notice'                => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'unicase' ),
            'preview_url'                  => 'https://demo2.chethemes.com/unicase-v2/',
        ),
    ) );
}

function unicase_ocdi_after_import_setup( $selected_import ) {
    
    // Assign menus to their locations.
    $topbar_left_menu       = get_term_by( 'name', 'Top Left Nav', 'nav_menu' );
    $topbar_right_menu      = get_term_by( 'name', 'Top Right Nav', 'nav_menu' );
    $primary_menu           = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
    $handheld_menu          = get_term_by( 'name', 'Vertical Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'topbar-left'           => $topbar_left_menu->term_id,
            'topbar-right'          => $topbar_right_menu->term_id,
            'primary'               => $primary_menu->term_id,
            'hand-held'              => $handheld_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home v1' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

    if ( 'Unicase-v2' === $selected_import['import_file_name'] ) {
        unicase_ocdi_import_wpforms('v2');
    } else {
        unicase_ocdi_import_wpforms('v1');
    }

}

function unicase_ocdi_import_wpforms($demo_path = 'v1') {
    if ( ! function_exists( 'wpforms' ) ) {
        return;
    }

    $forms = [
        [
            'file' => 'wpforms-contact-form.json'
        ],
        [
            'file' => 'wpforms-subscribe-form.json'
        ]
    ];

    foreach ( $forms as $form ) {
        ob_start();
        unicase_get_template( $form['file'], array(), 'assets/dummy-data/' . $demo_path . '/' );
        $form_json = ob_get_clean();
        $form_data = json_decode( $form_json, true );

        if ( empty( $form_data[0] ) ) {
            continue;
        }
        $form_data = $form_data[0];
        $form_title = $form_data['settings']['form_title'];

        if( !empty( $form_data['id'] ) ) {
            $form_content = array(
                'field_id' => '0',
                'settings' => array(
                    'form_title' => sanitize_text_field( $form_title ),
                    'form_desc'  => '',
                ),
            );

            // Merge args and create the form.
            $form = array(
                'import_id'     => (int) $form_data['id'],
                'post_title'    => esc_html( $form_title ),
                'post_status'   => 'publish',
                'post_type'     => 'wpforms',
                'post_content'  => wpforms_encode( $form_content ),
            );

            $form_id = wp_insert_post( $form );
        } else {
            // Create initial form to get the form ID.
            $form_id   = wpforms()->form->add( $form_title );
        }

        if ( empty( $form_id ) ) {
            continue;
        }

        $form_data['id'] = $form_id;
        // Save the form data to the new form.
        wpforms()->form->update( $form_id, $form_data );
    }
}
