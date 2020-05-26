<?php

namespace SaberTheme;

class TemplateImporter {

  /**
	 * Reach out to Elementor to import a local JSON file into the library.
	 * Returns the ID of the locally imported post.
	 *
	 * @param $json_file_path
	 * @param $template_index
	 *
	 * @return int|\WP_Error
	 */
	public function import_json_file_to_elementor_library( $template_json_file ) {

    include_once( ABSPATH . 'wp-admin/includes/image.php' );

    // Found the template to import from the manifest file.
		$local_json_data          = json_decode( file_get_contents( $template_json_file ), true );
		$source                   = \Elementor\Plugin::$instance->templates_manager->get_source( 'local' );
		$result                   = $source->import_template( basename( $template_json_file ), $template_json_file );

		if ( is_wp_error( $result ) ) {
			return new \WP_Error( 'import_error', 'Failed to import template: ' . esc_html( $result->get_error_message() ) );
		}

		if ( $result[0] && $result[0]['template_id'] ) {
			$imported_template_id = $result[0]['template_id'];
			// Check if we've got any display conditions to import:
			if ( $local_json_data['metadata'] && ! empty( $local_json_data['metadata']['elementor_pro_conditions'] ) ) {
				update_post_meta( $imported_template_id, '_elementor_conditions', $local_json_data['metadata']['elementor_pro_conditions'] );
			}
			if ( $local_json_data['metadata'] && ! empty( $local_json_data['metadata']['wp_page_template'] ) ) {
				// If there is a page template set we keep it the same here
				update_post_meta( $imported_template_id, '_wp_page_template', $local_json_data['metadata']['wp_page_template'] );
			}
			return $imported_template_id;
		}

		return new \WP_Error( 'import_error', 'Unknown import error' );
	}

}
