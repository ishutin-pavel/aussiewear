<?php
/*
 * Home Tags
*/
//id тегов:
$sfc_tag_ids = array( 21, 22, 23);
?>
<section class="home-tags">

  <h2 class="home-tags__title"><span>Свобода в движении</span></h2>

    <div class="row">

      <?php
      foreach ($sfc_tag_ids as $sfc_tag_id) {
        $term = get_term( $sfc_tag_id );
        $tag_name = $term->name;
        $tag_img = $term->description;
        $tag_slug = $term->slug;
        ?>
        <div class="col-sm-6 col-md-4">
          <div class="home-tags__item">
            <a href="/product-tag/<?php echo $tag_slug; ?>/">
              <div class="home-tags_img" style="background-image: url('<?php echo $tag_img; ?>');"></div>
              <div class="home-tags_name"><?php echo $tag_name; ?></div>
            </a>


          </div>
        </div><!-- .col -->

<?php }
      ?>

    </div><!-- .row -->

</section>