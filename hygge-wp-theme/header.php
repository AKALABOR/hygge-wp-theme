<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<?php
$body_id = '';
if ( is_page_template('template-migration.php') ) {
    $body_id = 'id="migration-page"';
}
?>
<body <?php echo $body_id; ?> <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <!-- ====== ШАПКА ====== -->
    <header class="navbar">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">Hygge<strong>System</strong></a>

        <button class="burger-btn" id="burger-btn" aria-label="Відкрити меню">
            <span></span><span></span><span></span>
        </button>

        <nav class="nav-container">
            <?php
            if ( has_nav_menu( 'menu-1' ) ) {
                // If they configure a dynamic menu later, it will load here. 
                // For now, we output the static HTML as a fallback or they can just use the static HTML if they want it editable only via files.
                // But the user requested WordPress standards, so let's use wp_nav_menu with a fallback.
                wp_nav_menu(
                    array(
                        'theme_location' => 'menu-1',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'nav-links',
                        'container'      => false,
                    )
                );
            } else {
            ?>
            <ul class="nav-links">
                <?php
                // Helper to dynamically get URL by template
                $get_tpl_url = function($template) {
                    $pages = get_posts(array(
                        'post_type' => array('post', 'page'),
                        'meta_key' => '_wp_page_template',
                        'meta_value' => $template,
                        'posts_per_page' => 1,
                        'fields' => 'ids'
                    ));
                    return $pages ? get_permalink($pages[0]) : '#';
                };
                ?>
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Головна</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link">Програми</a>
                    <div class="mega-menu">
                        <div class="mega-menu-container">
                            <!-- Колонки посилань -->
                            <div class="mega-links-row">
                                <?php
                                $programs = get_posts(array(
                                    'post_type'      => array('post', 'page'),
                                    'meta_key'       => '_wp_page_template',
                                    'meta_value'     => 'template-product-card.php',
                                    'posts_per_page' => -1,
                                ));

                                $func_progs = [];
                                $ind_progs = [];
                                $loc_progs = [];

                                foreach ( $programs as $prog ) {
                                    $cat = get_post_meta( $prog->ID, 'prod_category', true );
                                    if ( $cat === 'ind' ) {
                                        $ind_progs[] = $prog;
                                    } elseif ( $cat === 'loc' ) {
                                        $loc_progs[] = $prog;
                                    } else {
                                        $func_progs[] = $prog; // default to func
                                    }
                                }
                                ?>

                                <div class="mega-column">
                                    <h4><?php echo esc_html( get_theme_mod( 'header_col1_title', 'Функціональні модулі SAP Business One' ) ); ?></h4>
                                    <ul>
                                        <?php if ( empty($func_progs) ) : ?>
                                            <li><a href="#"><i>Поки немає програм</i></a></li>
                                        <?php else : ?>
                                            <?php foreach( $func_progs as $p ) : ?>
                                                <li><a href="<?php echo esc_url( get_permalink($p) ); ?>"><?php echo esc_html( get_the_title($p) ); ?></a></li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="mega-column">
                                    <h4><?php echo esc_html( get_theme_mod( 'header_col2_title', 'Індустріальні рішення' ) ); ?></h4>
                                    <ul>
                                        <?php if ( empty($ind_progs) ) : ?>
                                            <li><a href="#"><i>Поки немає рішень</i></a></li>
                                        <?php else : ?>
                                            <?php foreach( $ind_progs as $p ) : ?>
                                                <li><a href="<?php echo esc_url( get_permalink($p) ); ?>"><?php echo esc_html( get_the_title($p) ); ?></a></li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="mega-column">
                                    <h4><?php echo esc_html( get_theme_mod( 'header_col3_title', 'Локалізація для України' ) ); ?></h4>
                                    <ul>
                                        <?php if ( empty($loc_progs) ) : ?>
                                            <li><a href="#"><i>Поки немає локалізацій</i></a></li>
                                        <?php else : ?>
                                            <?php foreach( $loc_progs as $p ) : ?>
                                                <li><a href="<?php echo esc_url( get_permalink($p) ); ?>"><?php echo esc_html( get_the_title($p) ); ?></a></li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div><!-- /mega-links-row -->
                        </div>
                    </div>
                </li>
                <li><a href="<?php echo esc_url( $get_tpl_url('template-sap-b1.php') ); ?>">SAP Business One</a></li>
                <li><a href="<?php echo esc_url( $get_tpl_url('template-migration.php') ); ?>" class="nav-btn-special">Перехід з інших програм</a></li>
                <li><a href="<?php echo esc_url( $get_tpl_url('template-promos.php') ); ?>" class="nav-promo-highlight">Акції</a></li>
                <li class="nav-item simple-dropdown">
                    <a href="#" class="nav-link">Про нас</a>
                    <div class="simple-menu">
                        <ul>
                            <li><a href="<?php echo esc_url( $get_tpl_url('template-cases.php') ); ?>">Кейси</a></li>
                            <li><a href="#contacts">Контакти</a></li>
                            <li><a href="<?php echo esc_url( $get_tpl_url('template-blog.php') ); ?>">Блог</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <?php } ?>
        </nav>
    </header>
