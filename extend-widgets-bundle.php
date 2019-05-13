<?php
/*
Plugin Name: Extra Widgets for SiteOrigin
Description: Additional custom made SiteOrigin widgets
Author: Alexist Ong
*/

function add_extra_siteorigin_widgets_collection($folders){
    $folders[] = plugin_dir_path(__FILE__).'so-extra-widgets/';
    return $folders;
}
add_filter('siteorigin_widgets_widget_folders', 'add_extra_siteorigin_widgets_collection');