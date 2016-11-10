<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package Cryout Creations
 * @subpackage mantra
 * @since mantra 0.5
 */
?>	<div style="clear:both;"></div>

	</div> <!-- #forbottom -->
	</div><!-- #main -->


	<footer id="footer" role="contentinfo">
		<div id="colophon">
		
			<?php get_sidebar( 'footer' );?>
			
		</div><!-- #colophon -->

		<div id="footer2">
		
			<?php cryout_footer_hook(); ?>
			<?php bloginfo('name'); echo "&nbsp;&copy;&nbsp;2012 - " .gmdate(Y) ?> | Web běží na <a href="http://www.cesky-hosting.cz/?d=40722f" target="_blank">Českém hostingu</a>
			<br />
			Články(díla), zveřejněné na tomto webu, podléhají licenci <a rel="license" href="https://creativecommons.org/licenses/by-nc-sa/3.0/deed.cs">Creative Commons - Uveďte autora a zdroj - Nevyužívejte dílo komerčně - Zachovejte licenci 3.0 Unported</a>.

			<script type="text/javascript">
			  window.___gcfg = {lang: 'cs'};
			  (function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
			
		</div><!-- #footer2 -->

	</footer><!-- #footer -->

</div><!-- #wrapper -->

<?php	wp_footer(); ?>

</body>
</html>
