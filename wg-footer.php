<footer class="limpiar">
	
    <div class="interior limpiar">
    	
        <div id="footer_izq">
        	
            <p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>
            <p>E-mail : escribanos@sutep.org.pe</p>
            <p>xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>
            <p>Telf.: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>
            <p>&nbsp;</p>
            <p>Resolución Recomendada 1024x768</p>
            <p>&nbsp;</p>
            <p>© 2013. Todos los derechos reservados.</p>
            
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
    var GalImg = jGalImg('.galeria-sidebar').royalSlider({
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

    jGalImg('.slide4link').click(function(e) {
        GalImg.goTo(4);
        return false;
    });
}); 
</script>