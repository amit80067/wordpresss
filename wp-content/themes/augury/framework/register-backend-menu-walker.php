<?php
if ( ! class_exists( 'Augury_Backend_Menu_Walker' ) ) {

	class Augury_Backend_Menu_Walker {

        function __construct() {

        	add_filter( 'wp_edit_nav_menu_walker', array( $this, 'dt_edit_nav_menu' ) );
        	add_action( 'wp_update_nav_menu_item', array( $this, 'dt_update_menu_item'), 10, 2 );
   			add_filter( 'wp_setup_nav_menu_item', array( $this, 'dt_add_custom_nav_fields' ) );

		}

        function dt_edit_nav_menu( $walker ) {

            return 'Augury_Walker_Nav_Menu_Edit';
		}

        function dt_update_menu_item( $menu_id, $menu_item_db_id ) {

            if ( is_array( $_REQUEST['menu-item-dt-menu-icon']) ) {
                $image_value = $_REQUEST['menu-item-dt-menu-icon'][$menu_item_db_id];
                update_post_meta( $menu_item_db_id, '_dt-menu-icon', $image_value );
            }

            if ( is_array( $_REQUEST['menu-item-dt-menu-image']) ) {
                $image_value = $_REQUEST['menu-item-dt-menu-image'][$menu_item_db_id];
                update_post_meta( $menu_item_db_id, '_dt-menu-image', $image_value );
            }

            if ( is_array( $_REQUEST['menu-item-dt-menu-image-position']) ) {
                $image_value = $_REQUEST['menu-item-dt-menu-image-position'][$menu_item_db_id];
                update_post_meta( $menu_item_db_id, '_dt-menu-image-position', $image_value );
            }

            if ( is_array( $_REQUEST['dt-menu-item-child-animation']) ) {
                $animation = $_REQUEST['dt-menu-item-child-animation'][$menu_item_db_id];
                update_post_meta( $menu_item_db_id, '_dt-child-menu-animation', $animation );
            }        	
        }

        function dt_add_custom_nav_fields( $menu_item ) {

            $menu_item->icon = get_post_meta( $menu_item->ID, '_dt-menu-icon', true );
            $menu_item->image = get_post_meta( $menu_item->ID, '_dt-menu-image', true );
            $menu_item->icon_position = get_post_meta( $menu_item->ID, '_dt-menu-image-position', true );
            $menu_item->child_menu_animation = get_post_meta( $menu_item->ID, '_dt-child-menu-animation', true );

            return $menu_item;
        }        


	}

	new Augury_Backend_Menu_Walker();

}


if( ! class_exists( 'Augury_Walker_Nav_Menu_Edit' ) ) {

	class Augury_Walker_Nav_Menu_Edit extends Walker_Nav_Menu {

		public function start_lvl( &$output, $depth = 0, $args = array() ) {}

		public function end_lvl( &$output, $depth = 0, $args = array() ) {}

		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $_wp_nav_menu_max_depth;
			$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

			ob_start();
			$item_id      = esc_attr( $item->ID );
			$removed_args = array(
				'action',
				'customlink-tab',
				'edit-menu-item',
				'menu-item',
				'page-tab',
				'_wpnonce',
			);

			$original_title = false;

			if ( 'taxonomy' == $item->type ) {
				$original_object = get_term( (int) $item->object_id, $item->object );
				if ( $original_object && ! is_wp_error( $original_title ) ) {
					$original_title = $original_object->name;
				}
			} elseif ( 'post_type' == $item->type ) {
				$original_object = get_post( $item->object_id );
				if ( $original_object ) {
					$original_title = get_the_title( $original_object->ID );
				}
			} elseif ( 'post_type_archive' == $item->type ) {
				$original_object = get_post_type_object( $item->object );
				if ( $original_object ) {
					$original_title = $original_object->labels->archives;
				}
			}

			$classes = array(
				'menu-item menu-item-depth-' . $depth,
				'menu-item-' . esc_attr( $item->object ),
				'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive' ),
			);

			$title = $item->title;

			if ( ! empty( $item->_invalid ) ) {
				$classes[] = 'menu-item-invalid';
				/* translators: %s: Title of an invalid menu item. */
				$title = sprintf( esc_html__( '%s (Invalid)','augury' ), $item->title );
			} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
				$classes[] = 'pending';
				/* translators: %s: Title of a menu item in draft status. */
				$title = sprintf( esc_html__( '%s (Pending)','augury' ), $item->title );
			}

			$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

			$submenu_text = '';
			if ( 0 == $depth ) {
				$submenu_text = 'style="display: none;"';
			}

			?>
			<li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo implode( ' ', $classes ); ?>">
				<div class="menu-item-bar">
					<div class="menu-item-handle">
						<span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo "{$submenu_text}"; ?>><?php esc_html_e( 'sub item','augury' ); ?></span></span>
						<span class="item-controls">
							<span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
							<span class="item-order hide-if-js">
								<?php
								printf(
									'<a href="%s" class="item-move-up" aria-label="%s">&#8593;</a>',
									wp_nonce_url(
										add_query_arg(
											array(
												'action'    => 'move-up-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
									),
									esc_attr__( 'Move up', 'augury' )
								);
								?>
								|
								<?php
								printf(
									'<a href="%s" class="item-move-down" aria-label="%s">&#8595;</a>',
									wp_nonce_url(
										add_query_arg(
											array(
												'action'    => 'move-down-menu-item',
												'menu-item' => $item_id,
											),
											remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ) )
										),
										'move-menu_item'
									),
									esc_attr__( 'Move down', 'augury' )
								);
								?>
							</span>
							<?php
							if ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) {
								$edit_url = admin_url( 'nav-menus.php' );
							} else {
								$edit_url = add_query_arg(
									array(
										'edit-menu-item' => $item_id,
									),
									remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) )
								);
							}

							printf(
								'<a class="item-edit" id="edit-%s" href="%s" aria-label="%s"><span class="screen-reader-text">%s</span></a>',
								$item_id,
								$edit_url,
								esc_attr__( 'Edit menu item', 'augury' ),
								__( 'Edit', 'augury' )
							);
							?>
						</span>
					</div>
				</div>

				<div class="menu-item-settings wp-clearfix" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">
					<?php if ( 'custom' == $item->type ) : ?>
						<p class="field-url description description-wide">
							<label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
								<?php esc_html_e( 'URL','augury' ); ?><br />
								<input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
							</label>
						</p>
					<?php endif; ?>
					<p class="description description-wide">
						<label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
							<?php esc_html_e( 'Navigation Label', 'augury' ); ?><br />
							<input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
						</label>
					</p>
					<p class="field-title-attribute field-attr-title description description-wide">
						<label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
							<?php esc_html_e( 'Title Attribute', 'augury' ); ?><br />
							<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
						</label>
					</p>
					<p class="field-link-target description">
						<label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
							<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
							<?php esc_html_e( 'Open link in a new tab','augury' ); ?>
						</label>
					</p>
					<p class="field-css-classes description description-thin">
						<label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
							<?php esc_html_e( 'CSS Classes (optional)','augury' ); ?><br />
							<input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode( ' ', $item->classes ) ); ?>" />
						</label>
					</p>
					<p class="field-xfn description description-thin">
						<label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
							<?php esc_html_e( 'Link Relationship (XFN)','augury' ); ?><br />
							<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
						</label>
					</p>
					<p class="field-description description description-wide">
						<label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
							<?php esc_html_e( 'Description','augury' ); ?><br />
							<textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
							<span class="description"><?php esc_html_e( 'The description will be displayed in the menu if the current theme supports it.','augury' ); ?></span>
						</label>
					</p>
					<!-- Custom Fields -->
						<?php $menu_icon = get_post_meta( $item->ID, "_dt-menu-icon",true);?>
						<p class="field-dt-menu-icon description description-wide">
							<label for="edit-menu-item-dt-menu-icon-<?php echo esc_attr( $item_id ); ?>">
								<?php esc_html_e( 'Menu Icon','augury' ); ?><br />
								<input type="text" id="edit-menu-dt-menu-icon-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-dt-menu-icon" name="menu-item-dt-menu-icon[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $menu_icon ); ?>" />
							</label>
						</p>

						<?php $menu_image = get_post_meta( $item->ID, "_dt-menu-image",true);?>
						<p class="field-dt-menu-image description description-wide">
							<label for="edit-menu-item-dt-menu-image-<?php echo esc_attr( $item_id ); ?>">
								<?php esc_html_e( 'Menu Image','augury' ); ?><br />
								<input type="text" id="edit-menu-dt-menu-image-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-dt-menu-image" name="menu-item-dt-menu-image[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $menu_image ); ?>" />
								<span class="description"><?php esc_html_e('Please use image url',  'augury'); ?></span>
							</label>
						</p>

						<?php $menu_image_pos = get_post_meta( $item->ID, "_dt-menu-image-position",true);?>
						<p class="field-dt-menu-image-position description description-wide">
							<label for="edit-menu-item-dt-menu-position-<?php echo esc_attr( $item_id ); ?>">
								<?php esc_html_e( 'Menu Icon / Image Position','augury' ); ?><br />
								<select id="edit-menu-item-dt-menu-image-position-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-dt-menu-image-position" name="menu-item-dt-menu-image-position[<?php echo esc_attr($item_id);?>]">
			                        <option value="left" <?php selected( $menu_image_pos, 'left' ); ?>><?php esc_html_e('Left','augury');?></option>
			                        <option value="top-left" <?php selected( $menu_image_pos, 'top-left' ); ?>><?php esc_html_e('Top - Left','augury');?></option>
			                        <option value="right" <?php selected( $menu_image_pos, 'right' ); ?>><?php esc_html_e('Right','augury');?></option>
			                        <option value="top-right" <?php selected( $menu_image_pos, 'top-right' ); ?>><?php esc_html_e('Top - Right','augury');?></option>
			                        <option value="top-center" <?php selected( $menu_image_pos, 'top-center' ); ?>><?php esc_html_e('Top - Center','augury');?></option>
								</select>
								<span class="description"><?php esc_html_e('Please select image position',  'augury'); ?></span>
							</label>
						</p>

						<?php $sub_menu_anim = get_post_meta( $item->ID, "_dt-child-menu-animation", true);?>
						<p class="field-dt-menu-child-animation description description-wide">
							<label for="edit-menu-item-dt-menu-child-animation-<?php echo esc_attr( $item_id ); ?>">
								<?php esc_html_e( 'Child Menu Animation','augury' ); ?><br />
								<select id="edit-menu-item-dt-menu-child-animation-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-dt-menu-item-child-animation" name="dt-menu-item-child-animation[<?php echo esc_attr($item_id);?>]"><?php
									$animations = apply_filters( 'dt_child_menu_animations', array( '' => esc_html__('None','augury'),   
										"animate dt_bigEntrance"        =>  esc_html__("bigEntrance",'augury'),
										"animate dt_bounce"             =>  esc_html__("bounce",'augury'),
										"animate dt_bounceIn"           =>  esc_html__("bounceIn",'augury'),
										"animate dt_bounceInDown"       =>  esc_html__("bounceInDown",'augury'),
										"animate dt_bounceInLeft"       =>  esc_html__("bounceInLeft",'augury'),
										"animate dt_bounceInRight"      =>  esc_html__("bounceInRight",'augury'),
										"animate dt_bounceInUp"         =>  esc_html__("bounceInUp",'augury'),
										"animate dt_bounceOut"          =>  esc_html__("bounceOut",'augury'),
										"animate dt_bounceOutDown"      =>  esc_html__("bounceOutDown",'augury'),
										"animate dt_bounceOutLeft"      =>  esc_html__("bounceOutLeft",'augury'),
										"animate dt_bounceOutRight"     =>  esc_html__("bounceOutRight",'augury'),
										"animate dt_bounceOutUp"        =>  esc_html__("bounceOutUp",'augury'),
										"animate dt_expandOpen"         =>  esc_html__("expandOpen",'augury'),
										"animate dt_expandUp"           =>  esc_html__("expandUp",'augury'),
										"animate dt_fadeIn"             =>  esc_html__("fadeIn",'augury'),
										"animate dt_fadeInDown"         =>  esc_html__("fadeInDown",'augury'),
										"animate dt_fadeInDownBig"      =>  esc_html__("fadeInDownBig",'augury'),
										"animate dt_fadeInLeft"         =>  esc_html__("fadeInLeft",'augury'),
										"animate dt_fadeInLeftBig"      =>  esc_html__("fadeInLeftBig",'augury'),
										"animate dt_fadeInRight"        =>  esc_html__("fadeInRight",'augury'),
										"animate dt_fadeInRightBig"     =>  esc_html__("fadeInRightBig",'augury'),
										"animate dt_fadeInUp"           =>  esc_html__("fadeInUp",'augury'),
										"animate dt_fadeInUpBig"        =>  esc_html__("fadeInUpBig",'augury'),
										"animate dt_fadeOut"            =>  esc_html__("fadeOut",'augury'),
										"animate dt_fadeOutDownBig"     =>  esc_html__("fadeOutDownBig",'augury'),
										"animate dt_fadeOutLeft"        =>  esc_html__("fadeOutLeft",'augury'),
										"animate dt_fadeOutLeftBig"     =>  esc_html__("fadeOutLeftBig",'augury'),
										"animate dt_fadeOutRight"       =>  esc_html__("fadeOutRight",'augury'),
										"animate dt_fadeOutUp"          =>  esc_html__("fadeOutUp",'augury'),
										"animate dt_fadeOutUpBig"       =>  esc_html__("fadeOutUpBig",'augury'),
										"animate dt_flash"              =>  esc_html__("flash",'augury'),
										"animate dt_flip"               =>  esc_html__("flip",'augury'),
										"animate dt_flipInX"            =>  esc_html__("flipInX",'augury'),
										"animate dt_flipInY"            =>  esc_html__("flipInY",'augury'),
										"animate dt_flipOutX"           =>  esc_html__("flipOutX",'augury'),
										"animate dt_flipOutY"           =>  esc_html__("flipOutY",'augury'),
										"animate dt_floating"           =>  esc_html__("floating",'augury'),
										"animate dt_hatch"              =>  esc_html__("hatch",'augury'),
										"animate dt_hinge"              =>  esc_html__("hinge",'augury'),
										"animate dt_lightSpeedIn"       =>  esc_html__("lightSpeedIn",'augury'),
										"animate dt_lightSpeedOut"      =>  esc_html__("lightSpeedOut",'augury'),
										"animate dt_pullDown"           =>  esc_html__("pullDown",'augury'),
										"animate dt_pullUp"             =>  esc_html__("pullUp",'augury'),
										"animate dt_pulse"              =>  esc_html__("pulse",'augury'),
										"animate dt_rollIn"             =>  esc_html__("rollIn",'augury'),
										"animate dt_rollOut"            =>  esc_html__("rollOut",'augury'),
										"animate dt_rotateIn"           =>  esc_html__("rotateIn",'augury'),
										"animate dt_rotateInDownLeft"   =>  esc_html__("rotateInDownLeft",'augury'),
										"animate dt_rotateInDownRight"  =>  esc_html__("rotateInDownRight",'augury'),
										"animate dt_rotateInUpLeft"     =>  esc_html__("rotateInUpLeft",'augury'),
										"animate dt_rotateInUpRight"    =>  esc_html__("rotateInUpRight",'augury'),
										"animate dt_rotateOut"          =>  esc_html__("rotateOut",'augury'),
										"animate dt_rotateOutDownRight" =>  esc_html__("rotateOutDownRight",'augury'),
										"animate dt_rotateOutUpLeft"    =>  esc_html__("rotateOutUpLeft",'augury'),
										"animate dt_rotateOutUpRight"   =>  esc_html__("rotateOutUpRight",'augury'),
										"animate dt_shake"              =>  esc_html__("shake",'augury'),
										"animate dt_slideDown"          =>  esc_html__("slideDown",'augury'),
										"animate dt_slideExpandUp"      =>  esc_html__("slideExpandUp",'augury'),
										"animate dt_slideLeft"          =>  esc_html__("slideLeft",'augury'),
										"animate dt_slideRight"         =>  esc_html__("slideRight",'augury'),
										"animate dt_slideUp"            =>  esc_html__("slideUp",'augury'),
										"animate dt_stretchLeft"        =>  esc_html__("stretchLeft",'augury'),
										"animate dt_stretchRight"       =>  esc_html__("stretchRight",'augury'),
										"animate dt_swing"              =>  esc_html__("swing",'augury'),
										"animate dt_tada"               =>  esc_html__("tada",'augury'),
										"animate dt_tossing"            =>  esc_html__("tossing",'augury'),
										"animate dt_wobble"             =>  esc_html__("wobble",'augury'),
										"animate dt_fadeOutDown"        =>  esc_html__("fadeOutDown",'augury'),
										"animate dt_fadeOutRightBig"    =>  esc_html__("fadeOutRightBig",'augury'),
										"animate dt_rotateOutDownLeft"  =>  esc_html__("rotateOutDownLeft",'augury')									
									) );
									
									foreach( $animations as $key => $value ) { ?>
										<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $sub_menu_anim, $key, true ); ?>><?php echo esc_html ( $value ); ?></option><?php
									}?>
								</select>
								<span class="description"><?php esc_html_e('Please select child menu animation.',  'augury'); ?></span>
							</label>
						</p>						

					<!-- Custom Fields -->					

					<?php do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args ); ?>

					<fieldset class="field-move hide-if-no-js description description-wide">
						<span class="field-move-visual-label" aria-hidden="true"><?php esc_html_e( 'Move','augury' ); ?></span>
						<button type="button" class="button-link menus-move menus-move-up" data-dir="up"><?php esc_html_e( 'Up one','augury' ); ?></button>
						<button type="button" class="button-link menus-move menus-move-down" data-dir="down"><?php esc_html_e( 'Down one','augury' ); ?></button>
						<button type="button" class="button-link menus-move menus-move-left" data-dir="left"></button>
						<button type="button" class="button-link menus-move menus-move-right" data-dir="right"></button>
						<button type="button" class="button-link menus-move menus-move-top" data-dir="top"><?php esc_html_e( 'To the top','augury' ); ?></button>
					</fieldset>

					<div class="menu-item-actions description-wide submitbox">
						<?php if ( 'custom' !== $item->type && false !== $original_title ) : ?>
							<p class="link-to-original">
								<?php
								/* translators: %s: Link to menu item's original object. */
								printf( esc_html__( 'Original: %s','augury' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' );
								?>
							</p>
						<?php endif; ?>

						<?php
						printf(
							'<a class="item-delete submitdelete deletion" id="delete-%s" href="%s">%s</a>',
							$item_id,
							wp_nonce_url(
								add_query_arg(
									array(
										'action'    => 'delete-menu-item',
										'menu-item' => $item_id,
									),
									admin_url( 'nav-menus.php' )
								),
								'delete-menu_item_' . $item_id
							),
							__( 'Remove', 'augury' )
						);
						?>
						<span class="meta-sep hide-if-no-js"> | </span>
						<?php
						printf(
							'<a class="item-cancel submitcancel hide-if-no-js" id="cancel-%s" href="%s#menu-item-settings-%s">%s</a>',
							$item_id,
							esc_url(
								add_query_arg(
									array(
										'edit-menu-item' => $item_id,
										'cancel'         => time(),
									),
									admin_url( 'nav-menus.php' )
								)
							),
							$item_id,
							__( 'Cancel','augury' )
						);
						?>
					</div>

					<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>" />
					<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
					<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
					<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
					<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
					<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
				</div><!-- .menu-item-settings-->
				<ul class="menu-item-transport"></ul>
			<?php
			$output .= ob_get_clean();
		}		
	}
}