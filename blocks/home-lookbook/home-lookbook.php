<?php
/*
 * LOOKBOOK
*/
//id страниц:
$sfc_lookbook_ids = array( 53, 54, 55, 56, 57, 58);
?>
<section class="lookbook">

    <h2 class="lookbook__title"><span>LOOKBOOK</span></h2>

    <div class="row">

      <?php
      foreach ($sfc_lookbook_ids as $sfc_lookbook_id) {
        $lookbook_name = get_the_title($sfc_lookbook_id);
        //$lookbook_img = get_the_post_thumbnail( $sfc_lookbook_id, 'thumbnail' );
        $lookbook_img = get_the_post_thumbnail_url( $sfc_lookbook_id, 'full' );
        ?>
        <div class="col-sm-6 col-md-4">
          <div class="lookbook__item">
            <a href="<?php echo get_permalink( $sfc_lookbook_id ); ?>">
              <div class="lookbook_img" style="background-image: url('<?php echo $lookbook_img; ?>');"></div>
              <div class="lookbook_name"><?php echo $lookbook_name; ?></div>
            </a>


          </div>
        </div><!-- .col -->

<?php }
      ?>

    </div><!-- .row -->

</section>