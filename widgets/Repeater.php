<?php

namespace SaberTheme;

class RepeaterWidget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'saber_repeater';
	}

	public function get_title() {
		return __( 'Repeater', 'saber-theme' );
	}

	public function get_icon() {
		return 'fa fa-code';
	}

	public function get_categories() {
		return [ 'general' ];
	}

  protected function _register_controls() {

    $this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style Section', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

    $this->add_control(
			'theme',
			[
				'label' => __( 'Theme', 'saber' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text'
			]
		);

    $this->end_controls_section();

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'saber' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

    /*
     * List of Elementor Templates
     */
    $elTemplates = get_posts([
     'posts_per_page' => -1,
     'post_type' => 'elementor_library'
    ]);
    $options = [];
    foreach( $elTemplates as $templatePost ) {
      $options[$templatePost->ID] = $templatePost->post_title;
    }

    $this->add_control(
			'item_template',
			[
				'label' => __( 'Item Template', 'saber' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'input_type' => 'select',
        'options' => $options
			]
		);

    $this->add_control(
			'post_type',
			[
				'label' => __( 'Post Type', 'saber' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text'
			]
		);

		$this->end_controls_section();



    /* Query Controls */
    $this->start_controls_section(
      'query_section',
      [
        'label' => __( 'Query', 'saber' ),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
      ]
    );

    $this->add_control(
			'limit',
			[
				'label' => __( 'Limit', 'saber' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text'
			]
		);

    $this->add_control(
			'order_by',
			[
				'label' => __( 'Order By', 'saber' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
        'default'   => 'date'
			]
		);

    $this->add_control(
			'order',
			[
				'label' => __( 'Order', 'saber' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text',
        'default'   => 'DESC'
			]
		);

    $this->add_control(
			'meta_key',
      [
				'label' => __( 'Meta Key', 'saber' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'text'
			]
		);

    $repeater = new \Elementor\Repeater();

    $repeater->add_control(
			'meta_query_key', [
				'label' => __( 'Key', 'saber-theme' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '' , 'saber-theme' ),
			]
		);

    $repeater->add_control(
			'meta_query_value', [
				'label' => __( 'Value', 'saber-theme' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '' , 'saber-theme' ),
			]
		);

    $repeater->add_control(
			'meta_query_compare', [
				'label' => __( 'Comparison', 'saber-theme' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '=' , 'saber-theme' ),
			]
		);

		$this->add_control(
			'meta_query_list',
			[
				'label' => __( 'Meta Query', 'saber-theme' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [],
				'title_field' => '{{{ meta_query_key }}}',
			]
		);
    $this->end_controls_section();

	}

  protected function render() {

		$settings = $this->get_settings_for_display();

		$postType = $settings['post_type'];
    $limit    = $settings['limit'];
    $order    = $settings['order'];
    $orderBy  = $settings['order_by'];
    $meta_key = $settings['meta_key'];

    $args = [
      'post_type'       => $postType,
      'posts_per_page'  => $limit,
      'order'           => $order,
      'orderby'         => $orderBy,
      'meta_key'        => $meta_key
    ];
		$posts = get_posts( $args );

		if( !empty( $posts )) :

			global $post;
			$originalPost = $post;

			foreach( $posts as $postItem ) {

        $postQueried = query_posts(['include'=>[$postItem->ID]]);

				$templatePost = get_post( $settings['item_template'] );

				$post = $postItem;
        $GLOBALS['post'] = $postItem;
				setup_postdata($post);
				$elementorContent = \ElementorPro\Plugin::elementor()->frontend->get_builder_content_for_display( $templatePost->ID );
        print $elementorContent;

        wp_reset_query();

			}

			// reset post so rest of page works normally
			$post = $originalPost;

		endif;

	}

}
