<?php
/*
Plugin Name: WP Wapuu Widget
Plugin URI: http://www.near-mint.com/blog/software/wp-wapuu-widget
Description: This plugin adds a widget that shows pretty Wapuu's image. Wapuu is the official character of WordPress Japanese local site.
Version: 0.4.3
Author: redcocker
Author URI: http://www.near-mint.com/blog/
Text Domain: wapuu_widget
Domain Path: /languages
*/
/*
Last modified: 2011/9/2
License: GPL v2
*/
/*  Copyright 2011 M. Sumitomo

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
/*
"Wapuu" was designed by Kazuko Kaneuchi under GPL v2 license or any later version.
Kazuko Kaneuchi's blog: http://blog.cgfm.jp/mutsuki/
*/

load_plugin_textdomain('wapuu_widget', false, dirname(plugin_basename(__FILE__)).'/languages');

class WapuuWidget extends WP_Widget {

	function WapuuWidget() {
		$widget_ops = array('classname' => 'WapuuWidget', 'description' => __("Wapuu Widget shows the official character of WordPress Japanese local site.", "wapuu_widget"));
		parent::WP_Widget(false, $name = __("Wapuu Widget", "wapuu_widget"), $widget_ops);	
	}

	function widget($args, $instance) {
		$wapuu_widget_plugin_url = plugin_dir_url(__FILE__);
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$wapuu_size = $instance['wapuu_size'];
		$wapuu_bg_color_enable = $instance['wapuu_bg_color_enable'];
		$wapuu_bg_color = $instance['wapuu_bg_color'];
		$wapuu_target = $instance['wapuu_target'];
		$wapuu_rel_attrib_enable = $instance['wapuu_rel_attrib_enable'];
		$wapuu_rel_attrib = $instance['wapuu_rel_attrib'];
		$wapuu_description = $instance['wapuu_description'];
		$wapuu_font_size = $instance['wapuu_font_size'];
		$wapuu_widget_plugin_dir = dirname(plugin_basename(__FILE__));
		$wapuu_image_path = WP_PLUGIN_DIR.'/'.$wapuu_widget_plugin_dir.'/wapuu_'.$wapuu_size.'.png';

		?>
			<?php
				echo $before_widget;

				if ($title) {
					echo $before_title . $title . $after_title;
				}
				
				echo '<div class="wapuu_widget" style="text-align:center">';

				if ($wapuu_target != "") {
					echo '<a href="'.esc_url($wapuu_target).'"';

					if ($wapuu_rel_attrib_enable == 1) {
						echo ' rel="'.$wapuu_rel_attrib.'" title="'.esc_attr(__('Wapuu', 'wapuu_widget')).'"';
					}

					echo '>';

				}

				echo '<img src="';

				if (!file_exists($wapuu_image_path)) {
					echo $wapuu_widget_plugin_url.'wapuu_380.png"';
				} else {
					echo $wapuu_widget_plugin_url.'wapuu_'.$wapuu_size.'.png"';
				}

				echo ' width="'.$wapuu_size.'" height="'.$wapuu_size.'" alt="'.esc_attr(__('Wapuu', 'wapuu_widget')).'"';

				if ($wapuu_bg_color_enable == 1) {
					echo ' style="background-color: '.$wapuu_bg_color.';"';
				}

				echo ' />';

				if ($wapuu_target != "") {
					echo '</a>';
				}

				if ($wapuu_description != "") {
					if ($wapuu_font_size != "") {
						echo '<p style="font-size: '.$wapuu_font_size.'px;">';
					} else {
						echo '<p>';
					}
					echo $wapuu_description.'</p>';
				}
				echo '</div>';

				echo $after_widget;
			?>
		<?php
	}

	function update($new_instance, $old_instance) {	
		// Checking value of image size
		if (!preg_match("/^[0-9]+$/", $new_instance['wapuu_size']) || preg_match("/^0+$/", $new_instance['wapuu_size'])) {
			$new_instance['wapuu_size'] = "150";
		}
		// Checking value of background color
		if (!preg_match("/^#[a-fA-F0-9]+$/", $new_instance['wapuu_bg_color']) || mb_strlen($new_instance['wapuu_bg_color']) != 7) {
			$new_instance['wapuu_bg_color'] = "#FFFFFF";
		}
		// Checking value of font size
		if (!preg_match("/^[0-9]+$/", $new_instance['wapuu_font_size'])) {
			$new_instance['wapuu_font_size'] = "";
		}

		// Resizing image
		$wapuu_widget_plugin_dir = dirname(plugin_basename(__FILE__));
		$wapuu_size = $new_instance['wapuu_size'];

		if (function_exists('imagecreatetruecolor') && !file_exists(WP_PLUGIN_DIR."/".$wapuu_widget_plugin_dir."/wapuu_".$wapuu_size.".png")) {
			$wapuu_image_path = WP_PLUGIN_DIR.'/'.$wapuu_widget_plugin_dir.'/wapuu_380.png';

			if (!file_exists($wapuu_image_path)) {
				wp_die(__("Orignal image file is not found.", "wapuu_widget"));
			}

			$wapuu_image = imagecreatefrompng($wapuu_image_path);

			list($image_w, $image_h) = getimagesize($wapuu_image_path);

			if (!$image_w || !$image_h) {
				wp_die(__("Invalid image size.", "wapuu_widget"));
			}

			$rsc_id = imagecreatetruecolor($wapuu_size, $wapuu_size);

			// Resizing image while preserving transparency begin
			imagealphablending($rsc_id, false);
			$color = imagecolorallocatealpha($rsc_id, 0, 0, 0, 127);
			imagefill($rsc_id, 0, 0, $color);
			imagesavealpha($rsc_id, true);
			// Resizing image while preserving transparency end

			imagecopyresampled($rsc_id,
				$wapuu_image,
				0,
				0,
				0,
				0,
				$wapuu_size,
				$wapuu_size,
				$image_w,
				$image_h
			);

			imagepng($rsc_id, WP_PLUGIN_DIR."/".$wapuu_widget_plugin_dir."/wapuu_".$wapuu_size.".png");
			imagedestroy($rsc_id); 
		}

		return $new_instance;
	}

	function form($instance) {				
		$title = esc_attr($instance['title']);
		$wapuu_size = $instance['wapuu_size'] == "" ? "150" : esc_attr($instance['wapuu_size']);
		$wapuu_bg_color_enable = $instance['wapuu_bg_color_enable'];
		$wapuu_bg_color = $instance['wapuu_bg_color'] == "" ? "#FFFFFF" : esc_attr($instance['wapuu_bg_color']);
		$wapuu_target = esc_attr($instance['wapuu_target']);
		$wapuu_rel_attrib_enable = $instance['wapuu_rel_attrib_enable'];
		$wapuu_rel_attrib = $instance['wapuu_rel_attrib'] == "" ? "lightbox" : esc_attr($instance['wapuu_rel_attrib']);
		$wapuu_description = esc_attr($instance['wapuu_description']);
		$wapuu_font_size = esc_attr($instance['wapuu_font_size']);
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e("Title:"); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('wapuu_size'); ?>"><?php _e("Image size:", "wapuu_widget"); ?> <input style="width: 50px;" class="widefat" id="<?php echo $this->get_field_id('wapuu_size'); ?>" name="<?php echo $this->get_field_name('wapuu_size'); ?>" type="text" value="<?php echo $wapuu_size; ?>" /> pixel</label></p>
			<p><label for="<?php echo $this->get_field_id('wapuu_bg_color_enable'); ?>"><?php _e("Background color:", "wapuu_widget"); ?> <input class="checkbox" name="<?php echo $this->get_field_name('wapuu_bg_color_enable'); ?>" type="checkbox" value="1" <?php if($wapuu_bg_color_enable == 1){echo 'checked="checked" ';} ?>/> <input style="width: 80px;" class="widefat" id="<?php echo $this->get_field_id('wapuu_bg_color'); ?>" name="<?php echo $this->get_field_name('wapuu_bg_color'); ?>" type="text" value="<?php echo $wapuu_bg_color; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('wapuu_target'); ?>"><?php _e("Image link URL:", "wapuu_widget"); ?> <input class="widefat" id="<?php echo $this->get_field_id('wapuu_target'); ?>" name="<?php echo $this->get_field_name('wapuu_target'); ?>" type="text" value="<?php echo $wapuu_target; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('wapuu_rel_attrib_enable'); ?>"><?php _e("Rel attribute:", "wapuu_widget"); ?> <input class="checkbox" name="<?php echo $this->get_field_name('wapuu_rel_attrib_enable'); ?>" type="checkbox" value="1" <?php if($wapuu_rel_attrib_enable == 1){echo 'checked="checked" ';} ?>/> <input style="width: 80px;" class="widefat" id="<?php echo $this->get_field_id('wapuu_rel_attrib'); ?>" name="<?php echo $this->get_field_name('wapuu_rel_attrib'); ?>" type="text" value="<?php echo $wapuu_rel_attrib; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('wapuu_description'); ?>"><?php _e("Description:", "wapuu_widget"); ?> <input class="widefat" id="<?php echo $this->get_field_id('wapuu_description'); ?>" name="<?php echo $this->get_field_name('wapuu_description'); ?>" type="text" value="<?php echo $wapuu_description; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('wapuu_font_size'); ?>"><?php _e("Font size:", "wapuu_widget"); ?> <input style="width: 30px;" class="widefat" id="<?php echo $this->get_field_id('wapuu_font_size'); ?>" name="<?php echo $this->get_field_name('wapuu_font_size'); ?>" type="text" value="<?php echo $wapuu_font_size; ?>" /> px</label></p>
		<?php 
	}

}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("WapuuWidget");'));

?>