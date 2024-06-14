<?php
use DTElementor\Widgets\DTElementorWidgetBase;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class Elementor_Header_Menu extends DTElementorWidgetBase {

    public function get_name() {
        return 'dt-header-menu';
    }

    public function get_title() {
        return __('Header Menu', 'dt-elementor');
    }

    public function get_icon() {
		return 'fa fa-thumb-tack';
	}

    protected function register_controls() {

		$nav_menus = array( 0 => __('Select Menu', 'dt-elementor')  );
		$menus     = wp_get_nav_menus();

		foreach ($menus as $menu ) {
			$nav_menus[$menu->term_id] = $menu->name;
		}

        $this->start_controls_section( 'dt_section_general', array(
            'label' => __( 'General', 'dt-elementor'),
        ) );
            $this->add_control( 'nav_id', array(
				'type'    => Controls_Manager::SELECT,
				'label'   => __('Choose Menu', 'dt-elementor'),
				'default' => '0',
				'options' => $nav_menus
            ) );

            $this->add_responsive_control( 'align', array(
                'label'        => __( 'Alignment', 'dt-elementor' ),
                'type'         => Controls_Manager::CHOOSE,
                'prefix_class' => 'elementor%s-align-',
                'options'      => array(
                    'left'   => array( 'title' => __('Left','dt-elementor'), 'icon' => 'eicon-h-align-left' ),
                    'center' => array( 'title' => __('Center','dt-elementor'), 'icon' => 'eicon-h-align-center' ),
                    'right'  => array( 'title' => __('Right','dt-elementor'), 'icon' => 'eicon-h-align-right' ),
                )
            ) );            
        $this->end_controls_section();    	
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        extract($settings);


        $navigation = wp_nav_menu( array(
        	'menu'            => $nav_id,
			'container_class' => 'menu-container',
			'items_wrap'      => '<ul id="%1$s" class="%2$s" data-menu="'.$nav_id.'"> <li class="close-nav"></li> %3$s </ul> <div class="sub-menu-overlay"></div>',
			'menu_class'      => 'dt-primary-nav',
			'link_before'     => '<span>',
			'link_after'      => '</span>',
			'walker'          => new Augury_Walker_Nav_Menu,
			'echo' => false
        ) );

        $out = '<div class="dt-header-menu" data-menu="'.esc_attr( $nav_id ).'">';
        	$out .= $navigation;

            $out .= '<div class="mobile-nav-container mobile-nav-offcanvas-right" data-menu="'.esc_attr( $nav_id ).'">';
                $out .= '<div class="menu-trigger menu-trigger-icon" data-menu="'.esc_attr( $nav_id ).'">';
                    $out .= '<i></i>';
                    $out .= '<span>'.esc_html__('Menu','augury').'</span>';
                $out .= '</div>';
                $out .= '<div class="mobile-menu" data-menu="'.esc_attr( $nav_id ).'"></div>';
                $out .= '<div class="overlay"></div>';
            $out .= '</div>';

        $out .= '</div>';

        echo $out;

    }

}