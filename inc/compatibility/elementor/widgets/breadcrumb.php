<?php

use Elementor\Widget_Base;

defined('ABSPATH') || exit;


class masterwp_widget_breadcrumb extends Widget_Base {

	public function get_name() {
		return 'masterwp-breadcrumb';
	}


	public function get_title() {
		return __( 'Masterwp - Breadcrumb', 'masterwp' );
	}


	public function get_icon() {
		return ' eicon-chevron-double-right';
	}


	public function get_categories() {
		return array( 'basic' );
	}

	public function get_keywords() {
		return array( 'xpertpoint', 'breadcrumbs', 'crumbs', 'list' );
	}


    protected function is_dynamic_content(): bool {
        return false;
    }
	
	protected function register_controls() {

	}

	protected function render() {
		do_action('masterwp_action_get_breadcrumb');
	}

}
