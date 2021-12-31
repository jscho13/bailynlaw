<?php
include DIR_ROOT.DIR_THEME_PARTIAL.'/header.php';
include DIR_ROOT.DIR_THEME_PARTIAL.'/menu.php';
?>
<style>
iframe{
  margin: 16px 0px;
  max-width: 100%;
}

.inline-links{
  display: inline;
  padding: 16px;
}
.text-center{
  text-align: center;
}

.share-container{
  margin: 16px;
}


.vcast-container{
  padding: 16px;
}
</style>

<?php

$vlog_query = tep_db_query("select * from 	bailynlaw_ci_vlog where permalink = '".$slug."'");
$vlog = tep_db_fetch_array($vlog_query);

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

if($transcript == ''){
  $transcript = 'Sorry, currently there is no transcript for this video. <br/>If it is important please email us right away at brad@bailynlaw.com';
}
?>
<section id="episodes" class="container-fluid">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 order-2 order-lg-1">		

        <div class="vlog_card">

          <div class="vlog_episode_card">
            <p class="date"><?php echo $date; ?></p>
            <h2 class="header"><?php echo $title;?></h2>
          </div>
          <div class="video-container">
            <iframe width="560" height="315"  src="https://www.youtube.com/embed/<?php echo $youtube_link_id;?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
          </div>
          <hr/>
          <p>
          <?php echo $transcript;?>
          </p>				
        </div>
      </div>
      <div class="col-lg-4 text-center order-1 order-lg-2">
        <div class="share-container">
          <a href="<?php echo SITE_URL?>/vlog/think-like-a-lawyer/" class="inline-links" title="Think Like A Lawyer Vlog">Back</a> |
          <a href="https://twitter.com/intent/tweet?text=Think+Like+A+Lawyer+Vlog&url=https%3A%2F%2Fbailynlaw.com%2Fthink-like-a-lawyer/<?php echo $permalink;?>" target="_blank"  class="inline-links" title="Share on Twitter"><i aria-hidden="true" class="fa fa-twitter"></i></a> |

          <a href="https://www.facebook.com/sharer.php?quote=Think+Like+A+Lawyer+Vlog&u=https%3A%2F%2Fbailynlaw.com%2Fthink-like-a-lawyer/<?php echo $permalink;?>" target="_blank"  class="inline-links" title="Share on Facebook"><i aria-hidden="true" class="fa fa-facebook"></i></a> |

          <a href="https://www.linkedin.com/shareArticle?mini=true&url=https%3A//bailynlaw.com/think-like-a-lawyer/<?php echo $permalink;?>&title=Think%20Like%20A%20Lawyer%20Vlog&summary=&source=" target="_blank"  class="inline-links" title="Share on Linkedin"><i aria-hidden="true" class="fa fa-linkedin"></i></a> |

          <a href="https://youtu.be/<?php echo $youtube_link_id;?>" target="_blank"  class="inline-links" title="Watch on Youtube and Subscribe"><i aria-hidden="true" class="fa fa-youtube"></i></a>
        </div>
        <?php include DIR_ROOT.DIR_THEME_PARTIAL.'/contact-form-free.php';?>
        <div class="vcast-container">
          <h2 class="header">Related Episodes</h2>

<?php

$featured_vlogs_query = tep_db_query("select * from 	bailynlaw_ci_vlog where status = 'published' order by id desc");

$limit = 0;
$page_permalink = $slug;

while ($vlog = tep_db_fetch_array($featured_vlogs_query)){


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

  if ($page_permalink == $permalink){} else{
    $limit += 1;

    if($limit < 5){
?>
          <div class="col-12 vlog_card">
            <div class="vlog_card_content">
              <div class="vlog_episode_card">
                <p class="date"><?php echo $date; ?></p>
                <p class="title"><?php echo $title; ?></p>
                <p class="author">by <span><?php echo $author; ?></span></p>
                <p class="description"><?php echo $description; ?></p>
                <p class="link"><a href="<?php echo SITE_URL?>/vlog/think-like-a-lawyer/<?php echo $permalink; ?>/"><i aria-hidden="true" class="fa fa-play-circle"></i> Watch Now</a></p>
              </div>
            </div>
          </div>
<?php			
    } else {
      // do nothing
    }
  }
}
?>
        </div>
      </div>

    </div>
  </div>
</section>

<?php include DIR_ROOT.DIR_THEME_PARTIAL.'/footer-home.php';?>
