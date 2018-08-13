<?php 
 #sitemap_language.xml
if(class_exists('WPSEO_Sitemaps_Router') and class_exists('WPSEO_Sitemaps_Renderer') and function_exists('qtrans_getLanguage') and class_exists('WPSEO_Sitemap_Timezone')){
	
	add_action( 'init', 'omazz_init', 2 );
	add_filter( 'redirect_canonical', 'omazz_redirect_canonical' );
	add_action( 'pre_get_posts', 'omazz_redirect', 1 );
	function omazz_redirect_canonical( $redirect ) {
		if ( get_query_var( 'sitemap_language' )) {
			return false;
		}
		return $redirect;
	}
	function omazz_init() {
		global $wp;
		$wp->add_query_var( 'sitemap_language' );
		add_rewrite_rule( 'sitemap_language\.xml$', 'index.php?sitemap_language=1', 'top' );
	}
	
	function omazz_create_sitemap(){
		$lastmod = omazz_lastmod();
		$stylesheet_url       = preg_replace( '/(^http[s]?:)/', '', omazz_xsl_url() );
		$xml = '<?xml-stylesheet type="text/xsl" href="' . esc_url( $stylesheet_url ) . '"?>';
		$enabled_languages = get_option('qtranslate_enabled_languages');
		$links = array();
		if(isset($enabled_languages) and is_array($enabled_languages)){			
			foreach($enabled_languages as $item){
				$links[] = array(
					'loc' => site_url($item).'/sitemap_index.xml',
					'lastmod' => $lastmod
				);
			}
			$xml .= omazz_get_index($links);
		}
		return $xml;
	}
	
	function omazz_lastmod(){
		$res = null;
		$args = array(
			'posts_per_page'   => 1,
			'orderby'          => 'modified',
			'order'            => 'DESC',
			'post_status'      => 'publish',
		);
		$lastmods = get_posts( $args );
		foreach ( $lastmods as $lastmod ) : setup_postdata( $lastmod );
			$res = get_the_modified_date("Y/m/d H:i:s",$lastmod->ID);
		endforeach; 
		wp_reset_postdata();
		
		return $res;
	}
	
	function omazz_xsl_url(){
		return get_template_directory_uri().'/sitemap/main-sitemap.xsl';
	}
	
	function omazz_get_index($links){
		$timezone = new WPSEO_Sitemap_Timezone();
		
		$xml = '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

		foreach ( $links as $link ) {
			$xml .= omazz_sitemap_index_url( $link ,$timezone);
		}
		$xml .= '</sitemapindex>';

		return $xml;
	}
	
	function omazz_sitemap_index_url( $url,$timezone) {
		$date = null;
		if ( ! empty( $url['lastmod'] ) ) {
			$date = $timezone->format_date( $url['lastmod'] );
		}

		$url['loc'] = htmlspecialchars( $url['loc'] );

		$output  = "\t<sitemap>\n";
		$output .= "\t\t<loc>" . $url['loc'] . "</loc>\n";
		$output .= empty( $date ) ? '' : "\t\t<lastmod>" . htmlspecialchars( $date ) . "</lastmod>\n";
		$output .= "\t</sitemap>\n";

		return $output;
	}
	
	function omazz_redirect($query){
		if ( ! $query->is_main_query() ) {
			return;
		}
		$renderer = new WPSEO_Sitemaps_Renderer();
		$language = get_query_var( 'sitemap_language' );
		if ( ! empty( $language ) ) {
			header( 'HTTP/1.1 200 OK', true, 200 );
			// Prevent the search engines from indexing the XML Sitemap.
			header( 'X-Robots-Tag: noindex, follow', true );
			header( 'Content-Type: text/xml; charset=' . esc_attr( get_bloginfo( 'charset' ) ) );
			echo omazz_create_sitemap();
			die();
		}
		return;
	}
}


function omazz_wpseo_stylesheet_url( $stylesheet )
{
	$stylesheet = str_replace('index-', 'main-', $stylesheet);
	$stylesheet = str_replace('qtx-', 'main-', $stylesheet);
	$stylesheet = str_replace('qwp-', 'main-', $stylesheet);
	return $stylesheet;
}
add_filter('wpseo_stylesheet_url', 'omazz_wpseo_stylesheet_url');

?>
