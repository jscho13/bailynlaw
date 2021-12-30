<?php
    include DIR_ROOT.DIR_THEME_PARTIAL.'/header.php';
    include DIR_ROOT.DIR_THEME_PARTIAL.'/menu.php';
?>
<section id="ycbs-vlog-intro" class="container-fluid">
	<div class="container padding">
		<div class="row">
			<div class="col-lg-5">
				<div class="vlog_series_image_container">
					<div class="square-img-container">
						<img src="<?php echo DIR_HTTPS_CATALOG.DIR_IMAGES?>/think-like-a-lawyer.jpg" class="" alt="Bradley R. Bailyn, Esq., Founder" title="Bradley R. Bailyn, Esq., Founder">
					</div>
				</div>
			</div>
			<div class="col-lg-7">
				<div class="vlog-header-container">
					<h1 class="vlog_series_title white-text sr-only">Think Like A Lawyer Vlog</h1>
					<h2 class="vlog_series_subtitle white-text">#ThinkLikeALawyer Vlog</h2>
					<p class="white-text">
In this daily video podcast series, attorney-entrepreneur Bradley Bailyn educates and inspires New York business owners to turn the law around and enjoy
a far better quality of life. Change handicaps into competitive advantages, leverage contracts for maximum growth opportunities and fight back against greedy predators at every turn. <br><br>If you would like to ask a question for the podcast, please use any of the below social media channels, email <a href="mailto:brad@bailynlaw.com" class="plain-text-link">brad@bailynlaw.com</a> or call <a href="tel:+17188410025" class="plain-text-link">718-841-0025</a>.
					</p>
					<p class="white-text">
						Share: #thinklikealawyer 
						<a href="https://twitter.com/intent/tweet?hashtags=thinklikealawyer&amp;url=https%3A%2F%2Fbailynlaw.com%2Fvlog%2Fthink-like-a-lawyer" target="_blank" class="white-links" title="Share on Twitter"><i aria-hidden="true" class="fa fa-twitter social-icon share-icons"></i></a>
						
						<a href="https://www.facebook.com/sharer.php?u=https%3A%2F%2Fbailynlaw.com%2Fvlog%2Fthink-like-a-lawyer&amp;hashtag=#thinklikealawyer" target="_blank" class="white-links" title="Share on Facebook"><i aria-hidden="true" class="fa fa-facebook social-icon share-icons"></i></a>

						<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https%3A//bailynlaw.com/vlog/think-like-a-lawyer&amp;title=Think%20Like%20A%20Lawyer%20Vlog&amp;summary=&amp;source=" target="_blank" class="white-links" title="Share on Linkedin"><i aria-hidden="true" class="fa fa-linkedin social-icon share-icons"></i></a>

					</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="episodes" class="container-fluid">
	<div class="container">
		<div class="row">
			<h2 class="header">Episodes</h2>
			
			<?php 
        	    $all_vlogs_query = tep_db_query("select * from 	bailynlaw_ci_vlog where status = 'published' order by id desc");
        	    
        	    while ($vlog = tep_db_fetch_array($all_vlogs_query)){
        	        $title = $vlog['title'];
                    $sqldate = $vlog['date'];
                    $author = $vlog['author'];
                    $description = $vlog['description'];
                    $youtube_link_id = $vlog['youtube_link_id'];
                    $transcript = $vlog['transcript'];
                    $series = $vlog['series'];
                    $cover_image_path = $vlog['cover_image_path'];
                    $permalink = $vlog['permalink'];
                    $date_created = $vlog['date_created'];
                    $date_modified = $vlog['date_modified'];
                    
                    $date = strtotime($sqldate);
                    $date = date('F j, Y', $date);

        	 ?>
        	 <div class="col-12 vlog_card">
				<div class="vlog_card_content">
					<div class="vlog_episode_card">
						<p class="date"><?php echo $date; ?></p>
						<p class="title"><?php echo $title; ?></p>
						<p class="author">by <span><?php echo $author; ?></span></p>
						<p class="description"><?php echo $description; ?></p>
						
						<p class="link"><a href="<?php echo SITE_URL ?>/vlog/think-like-a-lawyer/<?php echo $permalink; ?>/"><i aria-hidden="true" class="fa fa-play-circle"></i> Watch Now</a></p> 
					</div>
				</div>
			</div>
			<?php
        	    }
			?>
		</div>
	</div>
  
<?php  
     include DIR_ROOT.DIR_THEME_PARTIAL.'/footer-home.php';