<?php
/**
 * Created by PhpStorm.
 * User: varun
 * Date: 20-02-2018
 * Time: 01:10 PM
 */


if( ! function_exists('vc_map_shortcode_defaults') ) {
    function vc_map_shortcode_defaults($args = array(), $defaults = array()) {
        $is_params = FALSE;
        $loop      = $args;
        if( isset($args['params']) ) {
            $is_params = TRUE;
            $loop      = $args['params'];
        }

        foreach( $loop as $i => $el ) {
            if( isset($el['param_name']) && isset($defaults[$el['param_name']]) ) {
                $loop[$i] = wp_parse_args($defaults[$el['param_name']], $el);
            }
        }

        if( $is_params ) {
            $args['params'] = $loop;
        } else {
            $args = $loop;
        }

        return $args;
    }
}

if( ! function_exists('vsp_vc_render_icon') ) {
    function vsp_vc_render_icon($options = array()) {
        $options = wp_parse_args($options, array(
            'icon_color'        => '',
            'icon_custom_color' => '',
            'icon_size'         => '',
            'icon_el_id'        => '',
            'icon_el_class'     => '',
            'icon'              => '',
            'customize'         => FALSE,
            'attributes'        => array(),
        ));

        $style = '';
        if( $options['customize'] !== FALSE ) {
            if( ! empty($options['icon_color']) ) {
                $icon_color = ( $options['icon_color'] === 'custom' ) ? $options['icon_custom_color'] : $options['icon_color'];
                $style      .= ' color:' . $icon_color . '; ';
            }

            if( ! empty($options['icon_size']) ) {
                $icon_size = $options['icon_size'];
                $style     .= ' size:' . $icon_size . '; ';
            }
        }

        $options['attributes']['style'] = $style;

        if( ! isset($options['attributes']['id']) ) {
            $options['attributes']['id'] = $options['icon_el_class'];
        }

        if( ! isset($options['attributes']['class']) ) {
            $options['attributes']['class'] = $options['icon_el_class'];
        }

        $options['attributes']['class'] .= ' ' . $options['icon'];

        $attr_html = vsp_array_to_html_attributes(array_filter($options['attributes']));


        return '<i ' . $attr_html . '> </i>';
    }

}

if( ! function_exists('vsp_vc_remap_group') ) {
    function vsp_vc_remap_group($args = array(), $remap_ids = array(), $group = '') {
        $is_params = FALSE;
        $loop      = $args;
        if( isset($args['params']) ) {
            $is_params = TRUE;
            $loop      = $args['params'];
        }

        foreach( $loop as $i => $el ) {
            if( isset($el['param_name']) && ( isset($defaults[$el['param_name']]) || in_array($el['param_name'], $remap_ids) ) ) {
                $loop[$i]['group'] = $group;
            }
        }

        if( $is_params ) {
            $args['params'] = $loop;
        } else {
            $args = $loop;
        }

        return $args;
    }
}