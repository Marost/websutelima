<footer class="limpiar">
	
    <div class="interior limpiar">
    	
        <div id="footer_izq">
        	
            <p>Jr. Camaná 550 - Lima Centro</p>
            <p>(Alt. cdra. 8 de la Av. Emancipación)</p>
            <p>Tel: (+511) 427-66-77</p>
            <p>Email: secretariageneral@sutelima.org</p>
            <p>&nbsp;</p>
            <p>Resolución Recomendada 1024x768</p>
            <p>&nbsp;</p>
            <p>© 2014. Todos los derechos reservados.</p>
            
        </div><!-- FIN FOOTER IZQUIERDA -->
        
    </div><!-- FIN INTERIOR -->
    
</footer><!-- FIN FOOTER -->

<!-- ROYAL SLIDER JS -->
<script src="libs/royalslider/jquery-1.8.3.min.js"></script>
<script src="libs/royalslider/jquery.royalslider.min.js"></script>

<!-- SLIDER PRINCIPAL -->
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
              enabled: true,
              delay: 7000
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

<!-- GALERIA DE IMAGENES -->
<script>
var jGalImg = jQuery.noConflict();
jGalImg(document).on("ready", function(){
    var GalImg = jGalImg('#galeria-img').royalSlider({
        addActiveClass: true,
        arrowsNav: false,
        controlNavigation: 'none',
        loop: false,
        fadeinLoadedSlide: false,
        globalCaption: true,
        keyboardNavEnabled: false,
        globalCaptionInside: false,
        visibleNearby: {
            enabled: true,
            centerArea: 0.9,
            center: true,
            breakpoint: 100,
            breakpointCenterArea: 0.8,
            navigateByCenterClick: true
        }
    }).data('royalSlider');
          
    jGalImg('#galimg-next').click(function() {
        GalImg.next();
    });
    
    jGalImg('#galimg-prev').click(function() {
        GalImg.prev();
    });
}); 
</script>

<!-- VIDEOS -->
<script>
var jGalVid = jQuery.noConflict();
jGalVid(document).on("ready", function(){
    var GalVid = jGalVid('#galeria-vid').royalSlider({
        addActiveClass: true,
        arrowsNav: false,
        controlNavigation: 'none',
        loop: false,
        fadeinLoadedSlide: false,
        globalCaption: true,
        keyboardNavEnabled: false,
        globalCaptionInside: false,
        visibleNearby: {
            enabled: true,
            centerArea: 0.9,
            center: true,
            breakpoint: 100,
            breakpointCenterArea: 0.8,
            navigateByCenterClick: true
        }
    }).data('royalSlider');
          
    jGalVid('#galvid-next').click(function() {
        GalVid.next();
    });
    
    jGalVid('#galvid-prev').click(function() {
        GalVid.prev();
    });
}); 
</script>

<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="js/html5.js"></script>
<![endif]-->

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-20229980-27', 'sutelima.org');
  ga('send', 'pageview');

</script>