<?php
global $theme;
get_header();
the_post();
?>
		<section id="content" role="main" class="full">
			<header id="content-title">
				<h1 class="page-title">
					<span>
						<?php echo wp_title(''); ?>
					</span>
				</h1>
			</header>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
				$meta = $theme->metaToData($post->ID);
				?>
				<div class="entry-content">
					<div class="staff-details clearfix">
						<div class="staff-picture">
							<?php 
							if (!has_post_thumbnail()) {
								echo $theme->Html->image('notpictured.jpg', array('alt' => 'Not pictured', 'parent' => true));
							} else {
								the_post_thumbnail('full');
							}
							?>				
						</div>
						<div>
							<dl>
							<?php
							$department = get_term($meta['department'], 'department');
							$meta['department'] = $department->name;
							$metaLabels = array(
								'email' => 'Email',
								'phone' => 'Phone',
								'department' => 'Ministry',
								'title' => 'Job Title',
								'hometown' => 'Hometown',
								'family' => 'Family'
							);
							foreach ($metaLabels as $metaName => $metaLabel) {
								if (!empty($meta[$metaName])) {
									echo $theme->Html->tag('dt', $metaLabel.':');
									echo $theme->Html->tag('dd', $meta[$metaName]);
								}
							}
							?>
							</dl>
						</div>
					</div>
					<div class="staff-bio">
						<?php the_content(__('Read More', 'rockharbor')); ?>
					</div>
				</div>
			</article>
		</section>
<?php 
get_footer();