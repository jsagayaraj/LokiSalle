</section>
<section id="footer_top_area">
			<div class="fix footer_top center">
				<div class="fix footer_top_container">
					<div class="footer_text">
								<ul >
								<?php
									echo'<li><a href="'.RACINE_SITE.'mentions_legales.php">Mentions légales</a></li>';
									echo'<li><a href="'.RACINE_SITE.'cgv.php">C.G.V</a></li>';
									echo'<li><a href="'.RACINE_SITE.'plandusite.php">Plan du site</a></li>';
									echo'<li><a href="javascript:window.print()">Imprimer la page</a></li>';
									echo'<li><a href="'.RACINE_SITE.'contact.php ">Contact</a></li>';
                                    echo'<li><a href="">Suivez-nous</a> 
                                    <a href="http://www.facebook.com" target="black"><img class="icon" src="images/facebook.png" alt="www.facebook.com" /></a>
                                    <a href="http://www.linkedin.com" target="black"><img class="icon" src="images/linkedin.png" alt="www.linkedin.com" /></a>
                                    <a href="http://www.twitter.com" target="black"><img class="icon" src="images/twitter.png" alt="www.twitter.com" /></a></li>';
                                ?>
                                </ul>
					</div>
                    <div class="copyright">
                        <p style = "color:white; font-size: 12px;">Lokisalle -  1 Rue paris,  75025  Paris  Téléphone : +33 (0)1 00 00 00 00  Fax : +33(0)1 00 00 00 00  Email : contact@lokisalle.fr </p>
                        <p style = "color:white; font-size: 12px;">Ce site a été créé dans le cadre d'une formation, dans le but de répondre à un atelier PHP. Ce site n'est pas réalisé dans un but commercial</p>
                    </div>
				</div>
			</div>
	</section>
		
	<script src="http://code.jquery.com/jquery.js"></script>
		<!-- Jessor slider Start-->
    <script type="text/javascript" src="<?php echo RACINE_SITE; ?>js/jssor.core.js"></script>
    <script type="text/javascript" src="<?php echo RACINE_SITE; ?>js/jssor.utils.js"></script>
    <script type="text/javascript" src="<?php echo RACINE_SITE; ?>js/jssor.slider.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $Loop: 2,                                       //[Optional] Enable loop(circular) of carousel or not, 0: stop, 1: loop, 2 rewind, default value is 1
                    $SpacingX: 3,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $SpacingY: 3,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 6,                              //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 204,                          //[Optional] The offset position to park thumbnail,

                    $ArrowNavigatorOptions: {
                        $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                        $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                        $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                        $Steps: 6                                       //[Optional] Steps to go for each navigation request, default value is 1
                    }
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$SetScaleWidth(Math.min(parentWidth, 980));
                else
                    window.setTimeout(ScaleSlider, 30);
            }

            ScaleSlider();

            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', ScaleSlider);
            }


            //if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
            //    $(window).bind("orientationchange", ScaleSlider);
            //}
            //responsive code end
        });
    </script>
		<!-- Jessor slider End-->
		<script type="text/javascript" src="js/selectnav.min.js"></script>
		<script type="text/javascript">
			selectnav('nav', {
			  label: '-Navigation-',
			  nested: true,
			  indent: '-'
			});
			selectnav('nav2', {
			  label: '-Navigation-',
			  nested: true,
			  indent: '-'
			});
			

		</script>	
		<script type="text/javascript">

/*$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});*/
		</script>		
		
<!--

This Template is designed by WpFreeware.com Team, You are allowed to change anything you like.
Find out More Awesome template at http://www.WpFreeware.com.

-->

	</body>
</html>
