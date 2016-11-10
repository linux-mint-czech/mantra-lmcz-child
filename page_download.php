<?php
/*
Template Name: Download page
*/
?>

<?php get_header(); ?>
<div id="main">

    <!-- content -->
    <div style="text-align: center; margin-top: 2em; margin-bottom: 1em"><h1>Linux Mint 18 Sarah je aktuální vydání</h1></div>
    <div style="text-align: center; color: black; margin-top: 0.5em; margin-bottom: 1em">Ze seznamu níže si vyberte verzi a pracovní prostředí a kliknutím na tlačítko s architekturou stahujte.</div>
    <div id="content" class="custom">
        <?php if (have_posts()) : ?>
        <?php
            $xml = simplexml_load_file('http://'.$_SERVER['HTTP_HOST'].'/downpage.xml');
            
            //Nabídka nebližšího serveru
        //    $response = file_get_contents("http://freegeoip.net/xml/".$_SERVER["REMOTE_ADDR"]);     
          //  $response = file_get_contents("http://api.hostip.info/?ip=".$_SERVER["REMOTE_ADDR"]); 
            
			//$geoip = new SimpleXMLElement($response);
			$countryCode = "cz"; //strtolower($geoip->countryAbbrev);
							
        ?>
  
    <div class="download-form">
        <h1><?php echo $xml->title; ?></h1>
  
        <table border="0" cellspacing="0" cellpadding="0" class="download-table">
            <tr>
                <td width="50%" class="desc">
                    <div class="description"> <?php echo $xml->description; ?> </div>
                </td>
          
                <td>
                   <select name="dist_version">
                       <?php

                           /**
                            * Vypíše všechny dostupné downloady z xml souboru.
                            */                           
                          foreach ( $xml->release as $release ) {
                               
                               if ( $release->build == "testing" ) {
                               	$url = $xml->rcUrl;
                               }
                               else {
                               	$url = $release->build == "debian" ? $xml->debianUrl : $xml->mainUrl;     
                               }
                                 
                               $url = str_replace('{ver}', $release->version, $url);
                               $url = str_replace('{build}', $release->build, $url);
                               $url = str_replace('{env}', $release->environment, $url);
							   $url = str_replace('{codename}', $release->codename, $url);
                               $url = str_replace('{country}', $xml->mirrorlist->$countryCode, $url);                              
                               

                               /** 
                                * Zkontroluje existenci subverze. Jestliže je přítomna, doplní její hodnotu do URL,
                                * jinak zástupný symbol nahradí prázdným řetězcem.
		               			*/ 
                              if ( strcmp( $release->update, "0") != 0 ) {
                                   $url = str_replace('{update}', "-".$release->update, $url);
								   $url = str_replace('-dvd', "", $url);
                               }
                               else {
                                   $url = str_replace('{update}', "", $url);
                               }

 								if ( strcmp( $release->subversion, "0") != 0 ) {
									$url = str_replace('{subver}', ".".$release->subversion, $url);
									$url = str_replace('-dvd', "", $url);
								}
								else {
                                   $url = str_replace('{subver}', "", $url);
                           		}
                  
                               echo '<option value="'.$url.'">'.$release->name.'</option>';                   
                           }
                          
                       ?>
                   </select>
               </td>
          
               <td class="download-td-small">                   
                   <div><button id="btn64">64-bit</button></div>
                   <div><button id="btn32">32-bit</button></div>
               </td>
           </tr>
            <tr>
                <td width="50%" class="desc">
                    <div class="description"> Torrenty: </div>
                </td>
          
                <td>
                   <select name="dist_version_torrent">
                       <?php

                           /**
                            * Vypíše všechny dostupné downloady z xml souboru.
                            */							
							foreach($xml->release as $release)
							{
								if($release["torrent"] == "yes")
								{
								   $url = $xml->torrentUrl;
								   $url = str_replace('{rc}', $release->build == "testing" ? "-beta" : "", $url); 
								   $url = str_replace('{ver}', $release->version, $url);
								   $url = str_replace('{env}', $release->environment, $url);
								   $url = str_replace('{codename}', $release->codename, $url);
									
								   /** 
									* Zkontroluje existenci subverze. Jestliže je přítomna, doplní její hodnotu do URL,
									* jinak zástupný symbol nahradí prázdným řetězcem.
									*/ 
									if ( strcmp( $release->update, "0") != 0 ) {
										$url = str_replace('{update}', "-".$release->update, $url);
										$url = str_replace('-dvd', "", $url);
									}
									else {
										$url = str_replace('{update}', "", $url);
									}

									if ( strcmp( $release->subversion, "0") != 0 ) {
										$url = str_replace('{subver}', ".".$release->subversion, $url);
										$url = str_replace('-dvd', "", $url);
									}
									else {
										$url = str_replace('{subver}', "", $url);
									}

									if ($release->build == "debian") {
										$url = str_replace('-dvd', "", $url);
									}

								   echo '<option value="'.$url.'">'.$release->name.'</option>';								   
								}
							}
                       ?>
                   </select>
               </td>
          
               <td class="download-td-small">                   
                   <div><button id="btn64t">64-bit</button></div>
                   <div><button id="btn32t">32-bit</button></div>
               </td>
           </tr>
       </table>
   </div>
   <table id="hash-table"><!--md5-->
   	<thead>
	   	<tr>
	   		<th>Název</th><th>Architektura</th><th>SHA256 Hash</th>
	   	</tr>
	</thead>
	<tbody>
		<?php

			/**
			* Vypíše všechny dostupné downloady z xml souboru.
			*/							
			foreach($xml->release as $release)
			{			
				$md5x64 = $release->md5->x64;
				$md5x86 = $release->md5->x86;

				echo "<tr>";
				echo '<td rowspan="2">'.$release->name.'</td>';	
				echo "<td>64bit</td><td>".$md5x64."</td></tr>";	
				echo "<tr class=\"center\"><td>32bit</td><td>".$md5x86."</td></tr>";							   
			}			
		?>
	</tbody>
	</table><!--/md5-->  

   <?php while (have_posts()) : the_post(); ?>
   <!-- item -->
   <div class="item entry" id="post-<?php the_ID(); ?>">
        <div class="itemhead">            
      	  <?php //the_content('Continue reading  &raquo;'); ?>
        </div>
   </div>
   <!-- end item -->

   <?php endwhile; ?> 
   
   <?php else : ?>
       <h2 class="center">Not Found</h2>
       <p class="center">Sorry, but you are looking for something that isn't here.</p>

   <?php endif; ?>


    </div>
    <!-- end content -->

    
<script type="text/javascript">
  jQuery(function() {
    var data = {};
    var combo = jQuery('select[name=dist_version]');
    var combot = jQuery('select[name=dist_version_torrent]');
    combo.find('option').eq(0).attr('selected', 'selected');
    combot.find('option').eq(0).attr('selected', 'selected');
    
    jQuery('#btn32').click(function(e) {
      data.url = combo.val();
      data.arch = '32bit';
      
      doDownload(e, data);
    });
    
    jQuery('#btn64').click(function(e) {
      data.url = combo.val();
      data.arch = '64bit';
      
      doDownload(e, data);
    });
    
     jQuery('#btn32t').click(function(e) {
      data.url = combot.val();
      data.arch = '32bit';
      
      doDownload(e, data);
    });
    
     jQuery('#btn64t').click(function(e) {
      data.url = combot.val();
      data.arch = '64bit';
      
      doDownload(e, data);
    });
  });
  
  function doDownload(e, data) {
    url = data.url;
    url = url.replace('{arch}', data.arch);
      
    e.preventDefault();  //stop the browser from following
    window.location.href = url;
  }
</script>
<?php get_footer(); ?>
