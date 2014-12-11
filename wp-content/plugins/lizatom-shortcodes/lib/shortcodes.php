<?php
    /**
	 * Shortcode: dropcap
	 *
	 * @param string $content
	 * @return string Output html
	 */
    function lts_dropcap_shortcode($atts, $content = null) {  

		extract(shortcode_atts(array(
			'type' => '',
		    'color' => ''), $atts));	

	    $output .= '<div class="lizatom-dropcap-' .$type. ' ' .$color. '">' . do_shortcode($content) . '</div>';
    
    return $output;   	
	
    }	
    /**
	 * Shortcode: blockquote
	 *
	 * @param string $content
	 * @return string Output html
	 */
    function lts_blockquote_shortcode($atts, $content = null) {  

    extract(shortcode_atts(array(
		'align' => 'none',
        'cite' => ''), $atts)); 
        if ($cite!='') { $our_cite = '<p><cite>' . $cite . '</cite></p>'; }
		$output .= '<blockquote class="align' . $align .'">';
        $output .= '<p>' . $content .'</p>';  
        $output .= $our_cite;      
	    $output .= '</blockquote>';
    
    return $output;   	
	
	}	
    /**
	 * Shortcode: pricing_table
	 *
	 * @param string $content
	 * @return string Output html
	 */
    function lts_pricing_table_shortcode($atts, $content = null) {  

    extract(shortcode_atts(array(
		'type' => ''), $atts)); 

		$output .= '<div class="lizatom-table">';
        $output .= $content;        
	    $output .= '</div>';
    
    return $output;   	
	
	}	
    /**
	 * Shortcode: highlighter
	 *
	 * @param string $content
	 * @return string Output html
	 */
    function lts_highlighter_shortcode($atts, $content = null) {  

    extract(shortcode_atts(array(
		'color' => 'red'), $atts)); 

		$output .= '<span class="lizatom-highlighter lizatom-highlighter-'.$color.'">' . $content . '</span>';    
        
    return $output;   	
	
	}	
	 /**
	 * Shortcode: frame
	 *
	 * @param string $content
	 * @return string Output html
	 */
    function lts_frame_shortcode($atts, $content = null) {  

    extract(shortcode_atts(array(
		'type' => ''), $atts)); 

		$output .= '<div class="lizatom-box-wrapper">';
		$output .= '<div class="lizatom-drop-shadow lizatom-'.$type.'">';
		$output .= '<img src="'.$content.'" alt="" title="" />';
		$output .= '</div>';
	    $output .= '</div>';
    
    return $output;   	
	
	}	
	/**
	 * Shortcode: list
	 *
	 * @param string $content
	 * @return string Output html
	 */
    function lts_list_shortcode($atts, $content = null) {  

    extract(shortcode_atts(array(
                              'icon' => ''), $atts));     	

		$output .= '<ul class="lizatom-list '.$icon.'">';
	    $output .= do_shortcode($content);    
        $output .= '</ul>';     
    
    return $output;   	
	
	}	

	/**
	 * Shortcode: service_primo
	 *
	 * @param string $content
	 * @return string Output html
	 */
    function lts_service_primo_shortcode($atts, $content = null) {  

		extract(shortcode_atts(array(
			'title' => '',
		    'icon' => '',
	        'size' => '48x48' ), $atts));     	
			$service_icon_path = lts_plugin_url() . '/images/services/primo/' . $size . '/' . $icon . '.png';

	    $output .= '<div class="lizatom-service-primo size-' .$size. '">';
		$output .= '<h3><img src="'.$service_icon_path.'" />' . $title . '</h3>'; 
	    $output .= do_shortcode($content);    
        $output .= '</div>';     
    
    return $output;   	
	
     }	
     /**
	 * Shortcode: service_fatcow
	 *
	 * @param string $content
	 * @return string Output html
	 */
    function lts_service_fatcow_shortcode($atts, $content = null) {  

		extract(shortcode_atts(array(
			'title' => '',
		    'icon' => '' ), $atts));     	
			$service_icon_path = lts_plugin_url() . '/images/services/fatcow/32x32/' . $icon . '.png';

	    $output .= '<div class="lizatom-service-fatcow">';
		$output .= '<h3><img src="'.$service_icon_path.'" />' . $title . '</h3>'; 
	    $output .= do_shortcode($content);    
        $output .= '</div>';     
    
    return $output;   	
	
      }	

 	/**
	 * Shortcode: columns
	 *
	 * @param string $content
	 * @return string Output html
	 */
    function lts_col_shortcode($atts, $content = null) {  

    extract(shortcode_atts(array(
                              'type' => ''), $atts));      	

    	$output .= '<div class="'.$type.'">';
	    $output .= do_shortcode($content);    
        $output .= '</div>'; 
		if (($type == 'one-half col-last') || 
			($type == 'one-third col-last') ||
			($type == 'one-fourth col-last') || 
			($type == 'one-fifth col-last') || 
			($type == 'one-half col-last') || 
			($type == 'one-sixth col-last') || 
			($type == 'two-third col-last') || 
			($type == 'two-fifth col-last') ||
			($type == 'three-fifth col-last') || 
			($type == 'four-fifth col-last') || 
			($type == 'five-sixth col-last')) {
			 $output .= '<div class="clear"></div>';
			}
    
    return $output;   	
	
    }

     /**
	 * Shortcode: accordions
	 *
	 * @param string $content
	 * @return string Output html
	 */
    function lts_accordions_shortcode($atts, $content = null) {  

    extract(shortcode_atts(array(), $atts));       	

	$output .= '<dl class="lizatom-accordion">';
	    $output .= do_shortcode($content);    
        $output .= '</dl>';     
    
    return $output;   	
	
    }
    
     /**
	 * Shortcode: accordion
	 *
	 * @param string $content
	 * @return string Output html
	 */
    function lts_accordion_shortcode($atts, $content = null) {  

    extract(shortcode_atts(array(
                              'title' => 'accordion title'), $atts));       	

        $output .= '<dt>' .$title. '</dt>';
        $output .= '<dd>';   
	    $output .= do_shortcode($content);    
        $output .= '</dd>';     
    
    return $output;   	
	
    }

    /**
	 * Shortcode: tabs
	 *
	 * @param string $content
	 * @return string Output html
	 */
    function lts_tabs_shortcode($atts, $content = null) {  

    extract(shortcode_atts(array(
                              'type' => 'lizatom-tabs-vertical'), $atts));       	

        $output .= '<dl class="'.$type.'">';
	    $output .= do_shortcode($content);    
		$output .= '<div style="clear:both;"></div></dl>';     
    
    return $output;   	
	
    }
    
     /**
	 * Shortcode: tab
	 *
	 * @param string $content
	 * @return string Output html
	 */
    function lts_tab_shortcode($atts, $content = null) {  

    extract(shortcode_atts(array(
                              'title' => 'Tab title'), $atts));       	

        $output .= '<dt>' .$title. '</dt>';
        $output .= '<dd>';   
	    $output .= do_shortcode($content);    
        $output .= '</dd>';     
    
    return $output;   	
	
 }

   /**
	 * Shortcode: simpletabs
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function lts_simpletabs_shortcode( $atts, $content ) {
		extract( shortcode_atts( array(
				'style' => 1
				), $atts ) );

		$GLOBALS['simpletab_count'] = 0;

		do_shortcode( $content );

		if ( is_array( $GLOBALS['simpletabs'] ) ) {
			foreach ( $GLOBALS['simpletabs'] as $tab ) {
				$tabs[] = '<span>' . $tab['title'] . '</span>';
				$panes[] = '<div class="lizatom-simpletabs-pane">' . $tab['content'] . '</div>';
			}
			$return = '<div class="lizatom-simpletabs lizatom-simpletabs-style-' . $style . '"><div class="lizatom-simpletabs-nav">' . implode( '', $tabs ) . '</div><div class="lizatom-simpletabs-panes">' . implode( "\n", $panes ) . '</div><div class="lt-spacer"></div></div>';
		}
		return $return;
	}

	/**
	 * Shortcode: simpletab
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function lts_simpletab_shortcode( $atts, $content ) {
		extract( shortcode_atts( array( 'title' => 'Tab %d' ), $atts ) );
		$x = $GLOBALS['simpletab_count'];
		$GLOBALS['simpletabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['simpletab_count'] ), 'content' => do_shortcode( $content ) );
		$GLOBALS['simpletab_count']++;
	 } 


	/**
	 * Shortcode: spoiler
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function lts_spoiler_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'title' => __( 'Spoiler title', 'lizatom-plugin-template' ),
				'style' => 0
				), $atts ) );

		return '<div class="lt-spoiler lt-spoiler-open lt-spoiler-style-' . $style . '"><div class="lt-spoiler-title">' . $title . '</div><div class="lt-spoiler-content">' . do_shortcode( $content ) . '</div></div>';
	}

	/**
	 * Shortcode: colorbox
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function lts_colorbox_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'color' => '#333',
				'title' => __( 'This is box title', 'lizatom-plugin-template' )
				), $atts ) );

		$styles = array(
			'dark_color' => lt_hex_shift( $color, 'darker', 20 ),
			'light_color' => lt_hex_shift( $color, 'lighter', 60 ),
			'text_shadow' => lt_hex_shift( $color, 'darker', 70 ),
		);

		return '<div class="lt-box" style="border:1px solid ' . $styles['dark_color'] . '"><div class="lt-box-title" style="background-color:' . $color . ';border-top:1px solid ' . $styles['light_color'] . ';text-shadow:1px 1px 0 ' . $styles['text_shadow'] . '">' . $title . '</div><div class="lt-box-content">' . do_shortcode( $content ) . '</div></div>';
	}

	/**
	 * Shortcode: note
	 *
	 * @param array $atts Shortcode attributes
	 * @param string $content
	 * @return string Output html
	 */
	function lts_note_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
				'color' => '#fc0'
				), $atts ) );

		$styles = array(
			'dark_color' => lt_hex_shift( $color, 'darker', 10 ),
			'light_color' => lt_hex_shift( $color, 'lighter', 20 ),
			'extra_light_color' => lt_hex_shift( $color, 'lighter', 80 ),
			'text_color' => lt_hex_shift( $color, 'darker', 70 )
		);

		return '<div class="lt-note" style="background-color:' . $styles['light_color'] . ';border:1px solid ' . $styles['dark_color'] . '"><div class="lt-note-shell" style="border:1px solid ' . $styles['extra_light_color'] . ';color:' . $styles['text_color'] . '">' . do_shortcode( $content ) . '</div></div>';
	}

    /**
	 * Shortcode: infobox
	 *
	 * @param string $content
	 * @return string Output html
	 */
	function lts_infobox_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
                'type' => 'success',
				'clickable' => 'no',
				'boldtext' => ''
				), $atts ) );
                $clickable_icon = '';
                if($clickable=="yes") { $clickable_icon='<span class="close-infobox"></span>'; } else { $clickable_icon = ''; }
                if($boldtext) { $boldtext = '<strong>' . $boldtext . '</strong>'; } else { $boldtext = ''; }

		return 
        '<div class="lizatom-infobox '.$type.'">'.$clickable_icon.'<div class="text"><p>'.$boldtext.' '. do_shortcode($content) . '</p></div></div>';
	}    

    /**
	 * Shortcode: tooltip
	 *
	 * @param string $content
	 * @return string Output html
	 */
	function lts_tooltip_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
                'position' => 'top',
				'color' => 'black',
				'delay' => '0',
                'tooltiptext' => 'tooltip text',
                'tooltiphead' => ''
				), $atts ) );
                
                if($tooltiphead) { $tooltiphead = '<strong>' . $tooltiphead . '</strong>'; } else { $tooltiphead = ''; }

		return 
        '<a class="lizatom-tooltip-'.$position.' lizatom-tooltip-'.$color.' delay-'.$delay.'" href="#"><span>'.
        $tooltiphead.
        do_shortcode($content).
        '</span>'.
        $tooltiptext.
        '</a>';
	}    

    /**
	 * Shortcode: sexybutton
	 *
	 * @param string $content
	 * @return string Output html
	 */
	function lts_sexybutton_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
                'url' => '#',
				'color' => 'default',
				'size' => 'small',
                'icon' => 'noicon'
				), $atts ) );
                
                if ($icon!="noicon") { $iconwrapper_start = '<span class="' .$icon . '">'; } else { $iconwrapper_start = ''; }
                if ($icon!="noicon") { $iconwrapper_end = '</span>'; } else { $iconwrapper_end = ''; }

		return 
        '<a class="sexybutton sexysimple sexy' . $color . ' sexy' . $size . '" href="' . $url . '">' . 
        $iconwrapper_start .
        $content . 
        $iconwrapper_end .
        '</a>';
	}	
?>
