<?php

$metabox = new Custom_Post_Type();
$metabox->post_type_name = 'page';
$metabox->add_meta_box(
	'Layout Options',
	array(
		'Hide Page Title' => array(
							'type' => 'checkbox',
							'data' => array(
										  'checked' => 'on',
									  ),
						),
		'Related Recipe' => 'custom-post-type-select',
		// Add more fields here
		
	),
	'side',
	'low',
	array(
		'custom-post-type-select' => array(
										'Related Recipe' => array(
													'post_type' => 'wpmon_recipe',
													'default_label' => 'Default',
													'args' => array(
																// Additional args for WP_Query here
															)
												),
									),
	),
	'',
	false
);

?>