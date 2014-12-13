<?php
// Initialize Post Type
$my_recipe = new Custom_Post_Type ( 'Recipe', 'wpmon',
										array(
											'menu_position' => '25',
											'menu_icon' => 'dashicons-images-alt',
											'has_archive' => 'false',
											'supports' => array('title', 'editor', 'thumbnail')
										),
										array(
											'menu_name' => 'Recipes'
										),
										'Recipe',
										true
										);


// Add Custom Taxonomy
$my_recipe->add_taxonomy( 'meal' );
$my_recipe->add_taxonomy( 'cuisine' );


// Add Metaboxes
$my_recipe->add_meta_box( 'Example Options',
							  array(
								'instructions' => 'html-block',
							  	'Select Some Things' => 'select',
							  	'Meal' => 'category-multi-select',
							  	'Test Question IDs' => 'hidden',
							  	'More Information Link' => 'content-url',
							  	'Date' => 'date',
							  	'Time' => 'time',
							  ),
							  'normal',
							  'default',
							  array(
								  'select_options' => array(
								  					    'Select Some Things' => array(
																				  // $label => $value
																				  'My Option 1' => 'option-1',
																				  'My Option 2' => 'option-2',
																				  'My Option 3' => 'option-3',
																				  'My Option 4' => 'option-4',
																				)
													  ),
								  'category_multi_select' => array(
									  					'Meal' => array(
										  					// $label => $value
										  					'post_type' => 'wpmon_recipe',
										  					'taxonomy' => 'wpmon_meals'
									  					)
									  				  ),
								  'html_block' => array(
									  				// field key => array()
									  				'instructions' => array(
									  									'heading' => 'Instructions',
									  									'html'	  => '[my-shortcode]',
									  								  )
								  				)
							  ),
							  '',
							  false
							);


function example_shortcode_function() {
	$output  = '<p>Here, you can place HTML content to give your users some good direction.</p>';
	$output .= '<p>You can even use shortcodes!!</p>';
	
	return $output;
}
add_shortcode( 'my-shortcode', 'example_shortcode_function' );

?>