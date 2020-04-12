<?php
function sermonpress_add_nav_menu_meta_boxes() {
    add_meta_box( 'sermonpress_endpoints_nav_link', __( 'SermonPress Endpoints', 'sermonpress' ), 'sermonpress_nav_menu_links' , 'nav-menus', 'side', 'low' );
}
add_action( 'admin_head-nav-menus.php', 'sermonpress_add_nav_menu_meta_boxes');

/**
 * Output menu links.
 */
function sermonpress_nav_menu_links() {
    // List Endpoint Options
    $endpoints = array();

    $endpoints['sermons'] = array(
        'label' => 'Sermon Archive',
        'url' => site_url(apply_filters('sermonpress_sermons_rewrite_slug', 'sermons'))
    );

    // Include missing lost password.
    $endpoints = apply_filters( 'sermonpress_custom_nav_menu_items', $endpoints );

    ?>
    <div id="posttype-sermonpress-endpoints" class="posttypediv">
        <div id="tabs-panel-sermonpress-endpoints" class="tabs-panel tabs-panel-active">
            <ul id="sermonpress-endpoints-checklist" class="categorychecklist form-no-clear">
                <?php
                $i = -1;
                foreach ( $endpoints as $key => $value ) :
                    ?>
                    <li>
                        <label class="menu-item-title">
                            <input type="checkbox" class="menu-item-checkbox" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-object-id]" value="<?php echo esc_attr( $i ); ?>" /> <?php echo esc_html( $value['label'] ); ?>
                        </label>
                        <input type="hidden" class="menu-item-type" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-type]" value="custom" />
                        <input type="hidden" class="menu-item-title" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-title]" value="<?php echo esc_html( $value['label'] ); ?>" />
                        <input type="hidden" class="menu-item-url" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-url]" value="<?php echo esc_url( $value['url'] ); ?>" />
                        <input type="hidden" class="menu-item-classes" name="menu-item[<?php echo esc_attr( $i ); ?>][menu-item-classes]" />
                    </li>
                    <?php
                    $i--;
                endforeach;
                ?>
            </ul>
        </div>
        <p class="button-controls">
            <span class="list-controls">
                <a href="<?php echo admin_url( 'nav-menus.php?page-tab=all&selectall=1#posttype-sermonpress-endpoints' ); ?>" class="select-all"><?php _e( 'Select all', 'sermonpress' ); ?></a>
            </span>
            <span class="add-to-menu">
                <input type="submit" class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e( 'Add to menu', 'woocommerce' ); ?>" name="add-post-type-menu-item" id="submit-posttype-sermonpress-endpoints">
                <span class="spinner"></span>
            </span>
        </p>
    </div>
    <?php
}
