<?php
use backend\assets\AppAsset;
use yii\web\JqueryAsset;
AppAsset::register($this);
$this->registerJsFile("@web/js/jquery.galleriffic.js", ['depends' => JqueryAsset::className()]);
$this->registerJsFile("@web/js/jquery.opacityrollover.js", ['depends' => JqueryAsset::className()]);
$this->registerJs("
    // We only want these styles applied when javascript is enabled
    $('div.navigation').css({'width' : '300px', 'float' : 'left'});
    $('div.content').css('display', 'block');

    // Initially set opacity on thumbs and add
    // additional styling for hover effect on thumbs
    var onMouseOutOpacity = 0.67;
    $('#thumbs ul.thumbs li').opacityrollover({
        mouseOutOpacity:   onMouseOutOpacity,
        mouseOverOpacity:  1.0,
        fadeSpeed:         'fast',
        exemptionSelector: '.selected'
    });

    // Initialize Advanced Galleriffic Gallery
    var gallery = $('#thumbs').galleriffic({
        delay:                     2500,
        numThumbs:                 15,
        preloadAhead:              10,
        enableTopPager:            true,
        enableBottomPager:         true,
        maxPagesToShow:            7,
        imageContainerSel:         '#slideshow',
        controlsContainerSel:      '#controls',
        captionContainerSel:       '#caption',
        loadingContainerSel:       '#loading',
        renderSSControls:          true,
        renderNavControls:         true,
        playLinkText:              '开始播放',
        pauseLinkText:             '暂停播放',
        prevLinkText:              '&lsaquo; 上一页',
        nextLinkText:              '下一页 &rsaquo;',
        nextPageLinkText:          '下一页 &rsaquo;',
        prevPageLinkText:          '&lsaquo; Prev',
        enableHistory:             false,
        autoStart:                 false,
        syncTransitions:           true,
        defaultTransitionDuration: 900,
        onSlideChange:function(prevIndex, nextIndex) {
            // 'this' refers to the gallery, which is an extension of $('#thumbs')
            this.find('ul.thumbs').children()
                .eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
                .eq(nextIndex).fadeTo('fast', 1.0);
        },
        onPageTransitionOut:function(callback) {
            this.fadeTo('fast', 0.0, callback);
        },
        onPageTransitionIn:function() {
            this.fadeTo('fast', 1.0);
        }
    });
");
?>
<?php $this->beginPage() ?>
<html>
    <head>
        <title>员工手册</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <style type="text/css">
            html, body {
                margin:0;
                padding:0;
            }
            body{
                text-align: center;
                font-family: "Lucida Grande", "Lucida Sans Unicode", Verdana, Helvetica, Arial, sans-serif;
                background-color: #eee;
                color: #444;
                font-size: 75%;
            }
            a{
                color: #27D;
                text-decoration: none;
            }
            a:focus, a:hover, a:active {
                text-decoration: underline;
            }
            p, li {
                line-height: 1.8em;
            }
            h1, h2 {
                font-family: "Trebuchet MS", Verdana, sans-serif;
                margin: 0 0 10px 0;
                letter-spacing:-1px;
            }
            h1 {
                padding: 0;
                font-size: 3em;
                color: #333;
            }
            h2 {
                padding-top: 10px;
                font-size:2em;
            }
            pre {
                font-size: 1.2em;
                line-height: 1.2em;
                overflow-x: auto;
            }
            div#page {
                width: 100%;
                background-color: #fff;
                margin: 0 auto;
                text-align: left;
                border-color: #ddd;
                border-style: none solid solid;
                border-width: medium 1px 1px;
            }
            div#container {
                padding: 20px;
            }
            div#ads {
                clear: both;
                padding: 12px 0 12px 66px;
            }
            div#footer {
                clear: both;
                color: #777;
                margin: 0 auto;
                padding: 20px 0 40px;
                text-align: center;
            }
            div.content {
                /* The display of content is enabled using jQuery so that the slideshow content won't display unless javascript is enabled. */
                display: none;
                float: right;
                width: 550px; 
            }
            div.content a, div.navigation a {
                text-decoration: none;
                color: #777;
            }
            div.content a:focus, div.content a:hover, div.content a:active {
                text-decoration: underline;
            }
            div.controls {
                margin-top: 5px;
                height: 23px;
            }
            div.controls a {
                padding: 5px;
            }
            div.ss-controls {
                float: left;
            }
            div.nav-controls {
                float: right;
            }
            div.slideshow-container {
                position: relative;
                clear: both;
                height: 502px; /* This should be set to be at least the height of the largest image in the slideshow */
            }
            div.loader {
                position: absolute;
                top: 0;
                left: 0;
                background-image: url('loader.gif');
                background-repeat: no-repeat;
                background-position: center;
                width: 550px;
                height: 502px; /* This should be set to be at least the height of the largest image in the slideshow */
            }
            div.slideshow {
            
            }
            div.slideshow span.image-wrapper {
                display: block;
                position: absolute;
                top: 0;
                left: 0;
            }
            div.slideshow a.advance-link {
                display: block;
                width: 550px;
                height: 502px; /* This should be set to be at least the height of the largest image in the slideshow */
                line-height: 502px; /* This should be set to be at least the height of the largest image in the slideshow */
                text-align: center;
            }
            div.slideshow a.advance-link:hover, div.slideshow a.advance-link:active, div.slideshow a.advance-link:visited {
                text-decoration: none;
            }
            div.slideshow img {
                vertical-align: middle;
                border: 1px solid #ccc;
            }
            div.download {
                float: right;
            }
            div.caption-container {
                position: relative;
                clear: left;
                height: 75px;
            }
            span.image-caption {
                display: block;
                position: absolute;
                width: 550px;
                top: 0;
                left: 0;
            }
            div.caption {
                padding: 12px;
            }
            div.image-title {
                font-weight: bold;
                font-size: 1.4em;
            }
            div.image-desc {
                line-height: 1.3em;
                padding-top: 12px;
            }
            div.navigation {
                /* The navigation style is set using jQuery so that the javascript specific styles won't be applied unless javascript is enabled. */
            }
            ul.thumbs {
                clear: both;
                margin: 0;
                padding: 0;
            }
            ul.thumbs li {
                float: left;
                padding: 0;
                margin: 5px 10px 5px 0;
                list-style: none;
            }
            a.thumb {
                padding: 2px;
                display: block;
                border: 1px solid #ccc;
            }
            ul.thumbs li.selected a.thumb {
                background: #000;
            }
            a.thumb:focus {
                outline: none;
            }
            ul.thumbs img {
                border: none;
                display: block;
            }
            div.pagination {
                clear: both;
            }
            div.navigation div.top {
                margin-bottom: 12px;
                height: 11px;
            }
            div.navigation div.bottom {
                margin-top: 12px;
            }
            div.pagination a, div.pagination span.current, div.pagination span.ellipsis {
                display: block;
                float: left;
                margin-right: 2px;
                padding: 4px 7px 2px 7px;
                border: 1px solid #ccc;
            }
            div.pagination a:hover {
                background-color: #eee;
                text-decoration: none;
            }
            div.pagination span.current {
                font-weight: bold;
                background-color: #000;
                border-color: #000;
                color: #fff;
            }
            div.pagination span.ellipsis {
                border: none;
                padding: 5px 0 3px 2px;
            }
        </style>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div id="page">
            <div id="container">
                <div id="gallery" class="content">
                    <div id="controls" class="controls"></div>
                    <div class="slideshow-container">
                        <div id="loading" class="loader"></div>
                        <div id="slideshow" class="slideshow"></div>
                    </div>
                    <div id="caption" class="caption-container"></div>
                </div>
                <div id="thumbs" class="navigation">
                    <ul class="thumbs noscript">
                        <li>
                            <a class="thumb" name="leaf" href="adminlte/img/avatar3.png" title="Title #0">
                                <img src="adminlte/img/avatar3.png" alt="Title #0" />
                            </a>
                            <div class="caption">
                                <div class="image-title">Title #0</div>
                                <div class="image-desc">Description</div>
                            </div>
                        </li>
                        <li>
                            <a class="thumb" name="leaf" href="adminlte/img/avatar3.png" title="Title #0">
                                <img src="adminlte/img/avatar3.png" alt="Title #0" />
                            </a>
                            <div class="caption">
                                <div class="image-title">Title #0</div>
                                <div class="image-desc">Description</div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div style="clear: both;"></div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>