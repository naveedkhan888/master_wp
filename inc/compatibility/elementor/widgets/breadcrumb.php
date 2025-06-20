<?php

use Elementor\Widget_Base;

defined('ABSPATH') || exit;


class lenity_widget_breadcrumb extends Widget_Base {

	public function get_name() {
		return 'lenity-breadcrumb';
	}


	public function get_title() {
		return __( 'Lenity - Breadcrumb', 'lenity' );
	}


	public function get_icon() {
		return ' eicon-chevron-double-right';
	}


	public function get_categories() {
		return array( 'basic' );
	}

	public function get_keywords() {
		return array( 'awaiken', 'breadcrumbs', 'crumbs', 'list' );
	}


    protected function is_dynamic_content(): bool {
        return false;
    }
	
	protected function register_controls() {

	}

	protected function render() {
		do_action('lenity_action_get_breadcrumb');
	}

}
