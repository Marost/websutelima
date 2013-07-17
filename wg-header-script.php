<link href="css/estilos.css" rel="stylesheet" type="text/css">
<link href="css/normalize.css" rel="stylesheet" type="text/css">

<!-- SLIDER PRINCIPAL -->
<link rel="stylesheet" href="libs/slideviewpro/svwp_style.css" type="text/css" media="screen" /> 
<script type="text/javascript" src="libs/slideviewpro/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="libs/slideviewpro/jquery.slideViewerPro.1.5.js"></script>
<script type="text/javascript" src="libs/slideviewpro/jquery.timers.js"></script>
<script type="text/javascript">
var jgalweb = jQuery.noConflict();
jgalweb(document).ready(function() {
    jgalweb("div#slider-principal").slideViewerPro({
		/*
		easeTime: 750,
		asTimer: 4000,
		thumbs: 0,
		thumbsVis: false,
		autoslide: true,
		typo: true,
		typoFullOpacity: 0.7,
		shuffle: false,
		galBorderWidth: 0
		*/

		galBorderWidth: 0,
		autoslide: true, 
		thumbsVis: false,
		shuffle: false,
		typo: true,
		asTimer: 4000
	});
});
</script>

<!-- SLIDER 
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="libs/bxslider/jquery.bxSlider.min.js"></script>
<script>
var jbx = jQuery.noConflict();
jbx(document).ready(function(){
	jbx('#slider1').bxSlider({
		auto: true,
		pager: true,
		pause: 10000	
	});
	jbx('#wg_cartas').bxSlider({
		auto: true,
		pause: 15000
	});
	jbx('.scsdbic_ctdSaludos').bxSlider({
		auto: true,
		pause: 10000,
		displaySlideQty: 3,
		moveSlideQty: 3,
		mode: 'vertical'
	});
});
</script>
-->

<!-- WIDGET VIDEOS 
<script src="js/jquery.tools.min.1.2.5.js"></script>
<script>
var jcv = jQuery.noConflict();
jcv(function(){
	jcv("#scsdbic_video_items ul").tabs("#scsdbic_video_select > div", {effect: 'fade', fadeOutSpeed: 400});
});
</script>
-->

<!-- VIDEOS 
<script src="js/flowplayer-3.2.6.min.js"></script>
-->

<!-- GALERIA DE FOTOS -->
<!--<link rel="stylesheet" href="css/svwp_style.css" type="text/css" media="screen" />
<script src="http://code.jquery.com/jquery-1.6.min.js"></script> 
<script src="libs/slideviewpro/jquery.slideViewerPro.1.5.js"></script>
<script>
var jgalweb = jQuery.noConflict();
jgalweb(document).ready(function(){
    jgalweb("div#pgaleria").slideViewerPro({
		thumbs: 3, 
		thumbsPercentReduction: 20,
		thumbsTopMargin: 5,
		thumbsRightMargin: 5,
		thumbsBorderWidth: 2,
		thumbsActiveBorderColor: "red",
		thumbsActiveBorderOpacity: 0.5,
		thumbsBorderOpacity: 0,
		buttonsTextColor: "#000",
		typo: true
	});
});
</script>

[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="js/html5.js"></script>
    <link href="css/ie.css" rel="stylesheet" type="text/css">
<![endif]-->