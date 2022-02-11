<?php
header("Content-Type:text/css");
$color = "";
$color2 = "";
function checkhexcolor($c)
{
    return preg_match('/^[a-f0-9]{6}$/i', $c);
}

if (isset($_GET['color']) && !empty($_GET['color']) && checkhexcolor($_GET['color'])) {
    $color = '#' . $_GET['color'];
}
if (!$color) {
    $color = "#ec4e20";
}
if (isset($_GET['color2']) && !empty($_GET['color2']) && checkhexcolor($_GET['color2'])) {
    $color2 = '#' . $_GET['color2'];
}
if (!$color2) {
    $color2 = "#faa603";
}
function hex2rgba($color, $opacity)
{
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }
    if (strlen($color) == 6) {
        list($r, $g, $b) = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
    } elseif (strlen($color) == 3) {
        list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
    } else {
        return false;
    }
    $r = hexdec($r);
    $g = hexdec($g);
    $b = hexdec($b);
    $rgb = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $opacity . ')';
    return $rgb;
}
?>

.bg--base, .btn--base::before, .btn--base::after, .btn--base.active:focus, .btn--base.active:hover, .feature-inner::after, ::selection, *::-webkit-scrollbar-thumb, *::-webkit-scrollbar-button, .service-footer::after, .video-area .video-icon, .submit-btn, .client-thumb .client-quote, .swiper-pagination .swiper-pagination-bullet, .blog-thumb .blog-date, .transaction-tab-menu .nav-item .nav-link.active, .footer-bottom-area::after, .faq-item .faq-title .right-icon::before, .faq-item .faq-title .right-icon::after, .faq-item.open .faq-title, .contact-info-icon i, .custom-table thead tr, .scrollToTop, .scrollToTop.active::before, .scrollToTop.active::after, input[type="radio"]:checked + label:before, .header-bottom-area .navbar-collapse .main-menu li .sub-menu li::before, .contact-info-icon i, .tag-item-wrapper .tag-item:hover, .pagination .page-item a,
  .pagination .page-item span {
    background-color: <?= $color ?> ;
}

.btn--base:focus, .btn--base:hover, .btn--base.active, .section-header .sub-title, .service-icon, .team-content-overlay .sub-title, .breadcrumb-item a,.breadcrumb-item.active::before, .footer-social li:hover, .cssload-dot, .text--base, .custom-table tbody tr td::before, .checkbox-wrapper .checkbox-item label a, .forgot-password a, .navbar-toggler span, .account-header .sub-title a, .category-content li:hover, .pagination .page-item.active span,.pagination .page-item.active a, .pagination .page-item:hover span, .pagination .page-item:hover a, .pagination .page-item.disabled span  {
    color: <?= $color ?> ;
}

.btn--base, .btn--base:focus, .btn--base:hover, .transaction-tab-menu .nav-item .nav-link.active, input[type="radio"]:checked + label:before  {
    border-color : <?= $color ?> ;
}


.section--bg, .service-footer::before, .bg-overlay-black:before, .banner-section, .header-section.header-fixed, .loading-box, .transaction-table table thead tr th, .loading-area, .team-content-overlay .title, .section--bg, .banner-section, .footer-section, .account-form-area, .page-container.show .sidebar-menu .sidebar-main-menu li a span:not(.badge) {
    background-color: <?= $color2 ?> !important;
}

.team-item, .team-content-overlay, .client-item,.plan-item, .blog-item, .blog-social-area, .widget-box, .transaction-table {
    border-color: <?= $color2 ?>;
}


@media only screen and (max-width: 991px) {
  .header-bottom-area .navbar-collapse {
    background-color: <?= $color2 ?>;
  }
}

@media (max-width: 991px) {
  .header-bottom-area .navbar-collapse .main-menu {
    background-color: <?= $color2 ?>;
  }
}

.pagination .page-item.disabled span {
    background-color: <?= $color ?>4D;
}