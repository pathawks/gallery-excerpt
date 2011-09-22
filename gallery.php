<?php
/*
Plugin Name: Gallery Excerpt
Plugin URI: http://dirtysuds.com
Description: Changes excerpt for 'Gallery' posts to a row of thumbnails
Author: Dirty Suds
Version: 1.00
Author URI: http://dirtysuds.com

Updates:
1.00 - First Version

  Copyright 2011 Pat Hawks  (email : pat@pathawks.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function dirtysuds_excerpt_gallery( $excerpt ) {
	if (has_post_format('gallery')) {
		global $post;
		$images = get_posts(array('post_parent'=>$post->ID,'post_type'=>'attachment','numberposts'=>'8',));
		echo '<a title="',get_the_title($post->ID),'" href="',get_permalink($post->ID),'" style="display:block;width:100%;height:100px;overflow:hidden;margin:0;padding:0"><span style="width:200%;display:block">';
		foreach( $images as $image ) :
			$img = wp_get_attachment_image_src($image->ID,array(300,100));
			echo '<img src="',$img[0],'" width="',$img[1],'" height="',$img[2],'" alt="',htmlentities(get_the_title($image->ID),ENT_QUOTES),' - ',get_the_title($post->ID),'" style="float:left;border-radius:0;border:none" />';
		endforeach;
		echo '</span></a>';
	} else {
		return $excerpt;
	}
}

add_filter('get_the_excerpt', 'dirtysuds_excerpt_gallery');