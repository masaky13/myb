<?php
/**
 * 繝医ャ繝励ｄ繧｢繝ｼ繧ｫ繧､繝紋ｸ隕ｧ
 */
 ?>
 <div class="post-list inner" uk-grid>
 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
     <div class="uk-flex uk-card uk-card-default uk-grid-collapse uk-margin-small" uk-grid>
         <div class="uk-width-1-4 uk-cover-container post-image">
             <a href="<?php the_permalink(); ?>">
                 <?php if ( has_post_thumbnail() ): // 繧ｵ繝繝阪う繝ｫ繧呈戟縺｣縺ｦ縺�ｋ縺ｨ縺阪�蜃ｦ逅 ?>
                     <?php $icatch = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
                     <img data-src="<?php echo $icatch[0]; ?>" class="lazyload" />
                 <?php else: // 繧ｵ繝繝阪う繝ｫ繧呈戟縺｣縺ｦ縺�↑縺�→縺阪�蜃ｦ逅 ?>
                     <img data-src="<?php echo get_template_directory_uri(); ?>/images/no-image.jpg" alt="no image" title="no image" class="lazyload">
                 <?php endif; ?>
             </a>
         </div>
         <div class="uk-width-expand uk-card-body uk-card-small post-info">
             <h3 class="post-title"><a href="<?php the_permalink(); ?>">
                 <?php if( wp_is_mobile() ) : ?>
                     <?php echo text_ellipsis( get_the_title(), 22 ); ?>
                 <?php else: ?>
                 <?php echo text_ellipsis( get_the_title(), 32 ); ?>
                 <?php endif; ?>
             </a></h3>
             <p class="post-date" itemprop="datePublished" datetime="<?php the_time('Y/m'); ?>"><?php the_time('Y/m'); ?></p>
             <?php echo or_get_category(); ?>
         </div>
     </div>
 <?php endwhile;
 else: ?>
     <p>險倅ｺ九′縺ゅｊ縺ｾ縺帙ｓ</p>
 <?php endif; ?>
 </div>
