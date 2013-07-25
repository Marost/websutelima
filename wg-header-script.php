<link href="css/estilos.css" rel="stylesheet" type="text/css">
<link href="css/normalize.css" rel="stylesheet" type="text/css">

<!-- SLIDER PRINCIPAL -->  
<link href="libs/royalslider/royalslider.css" rel="stylesheet">
<link href="libs/royalslider/skins/default-inverted/rs-default-inverted.css" rel="stylesheet">
<script src="libs/royalslider/jquery-1.8.3.min.js"></script>
<script src="libs/royalslider/jquery.royalslider.min.js"></script>
<script>
	var jSlPr = jQuery.noConflict();
	jSlPr(document).on("ready", function(){
		var SldPr = jSlPr('#slider-principal').royalSlider({
			fadeinLoadedSlide: true,		    
		    numImagesToPreload: 4,
		    autoHeight: false,
		    arrowsNav: true,
		    arrowsNavAutoHide: false,
		    fadeinLoadedSlide: false,
		    controlNavigationSpacing: 0,
		    controlNavigation: 'none',
		    imageScaleMode: 'fill',
		    imageAlignCenter: true,
		    loop: false,
		    loopRewind: false,	    
		    keyboardNavEnabled: false,
		    autoScaleSlider: true,
		    globalCaption:true,
		    autoPlay: {
		      enabled: false
		    }, 
		    imgWidth: 990,
		    imgHeight: 460
		}).data('royalSlider');
		  
		jSlPr('#slider-next').click(function() {
			SldPr.next();
		});
		
		jSlPr('#slider-prev').click(function() {
		    SldPr.prev();
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