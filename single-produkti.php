<?php
$cataloguePageID = get_field("catalogue", "options");
$menuPagePermalink = get_permalink($cataloguePageID);
$currentTaxID = get_queried_object();


get_header();

if (have_posts()) : while (have_posts()) :
    the_post();




$parentPageTitle = get_the_title($cataloguePageID);
//$menuPageDescription = get_field("page_description_menu", $menuPageID);

    $kategorijaPageID = get_field('catalogue', 'options');
    $kategorijaTitle = get_the_title($kategorijaPageID);





?>
    <script>
        let needed;
        let current;
        jQuery('.navbar-default .menu a').each(function () {
            needed = '<?=$parentPageTitle;?>'.toUpperCase();
            current = jQuery(this).html().toUpperCase();
            if (current == needed) {
                jQuery(this).parent().addClass('current-menu-item');
            }
        });
    </script>
    <div class="product-category-page inner-page-wrapper">
        <div class="content-wrapper">
            <h1 class="main-title"><?= $parentPageTitle; ?></h1>
            <div class="category-inner-wrapper d-flex">
                <!--CATEGORY LIST-->
                <div class="category-list w-100">
                    <div class="justify-content-end dropdown-mobile">
                        <button class="navbar-toggler navbar-toggler-right collapsed menu-button" type="button"
                                data-toggle="collapse" data-target="#category-list-mobile">
                            <span class="d-block burger-wrapper d-flex align-items-center mobile-dropdown-title"><?= __("Kategoriju saraksts", "mpp"); ?><img src="images/icons/arrow-dark-dd.png"></span>
                        </button>
                    </div>
                    <div class="mobile-dd collapse navbar-collapse" id="category-list-mobile">
                        <div>
                            <div class="category-list-wrapper flex-wrap d-flex">

                                <?php $kategorijasTaxonomy = get_terms([
                                    'taxonomy' => 'kategorijas',
                                    'hide_empty' => true,
                                ]);
                                if (!empty($kategorijasTaxonomy)) { ?>

                                    <div class="mobile-dd collapse navbar-collapse navbar-default" id="buttons-mobile">
                                        <div class="d-flex menu small-buttons flex-wrap">
                                            <?php foreach ($kategorijasTaxonomy as $kategorijaTax) {
                                                $termPermalink = get_term_link($kategorijaTax->term_id); ?>
                                                <?php
                                                echo "<pre>";
                                                print_r($kategorijaTax->term_id);
                                                echo "</pre>";




                                                echo "<pre>";
                                                print_r($currentTaxID);
                                                echo "</pre>";

                                                ?>
                                                <a href="<?= $termPermalink; ?>"
                                                   class="w-100  <?php if($kategorijaTax->term_id == $currentTaxID->term_id ) echo "current-menu-item"; ?>"><?= $kategorijaTax->name; ?></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php
                                } ?>

                            </div>
                        </div>
                    </div>
                </div>
                <!--CATEGORY LIST END-->
                <div class="product-list w-100"> <!--PRODUCT LIST-->

                    <?php
                        $postID = get_the_ID();
                        $thumb = get_the_post_thumbnail_url($postID, "medium_large");
                        $thumb_id = get_post_thumbnail_id($postID);
                        $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                        $subtext = get_field("product_description_subtitle");
                        $PDF = get_field("pdf");
                        $productDescription = get_field("product_description");
                        ?>
                    <div class="product-cards opened-product-card d-flex">

                        <div class="single-product-card cards-shadow">
                          <?php if ($thumb) { ?>
                          <div class="detail-image position-relative overflow-hidden d-block w-100 float-left">
                                <img src="<?= $thumb; ?>" alt="<?= $alt; ?>">
                            </div>
                          <?php } ?>

                                <div class="product-text"><?php the_title(); ?></div>
                                 <?php if ($subtext) { ?>
                                    <div class="product-description"><?= $subtext; ?></div>
                                 <?php } ?>

                                <?php if ($PDF) { ?>
                                <div class="download-pdf d-flex align-items-center justify-content-start flex-wrap" >
                                    <img class="pdf-icon" src="<?php bloginfo("template_url"); ?>/images/icons/pdf.svg" alt="PDF"> <a href="<?= $PDF['url']; ?>" target="_blank"><?= __("Tehniskā specifikācija", "mpp"); ?></a>
                                </div>
                                <?php }
                                  if ($productDescription) echo $productDescription ?>
                            

                        </div>

                    </div>

                    <h2 class="main-title">Citas preces no šīs kategorijas</h2>
                    <div class="product-cards d-flex flex-wrap">
                        <?php  require "included/single-product.php";  ?>

                    </div>
                </div><!--PRODUCT LIST END-->
            </div>
        </div>
    </div>


<?php endwhile;
else:
endif;
wp_reset_query();
get_footer(); ?>
