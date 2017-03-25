<?php get_header(); ?>

<!-- BEGIN #content -->
<div id="content">

	<!-- BEGIN .row -->
	<div class="row">
	
	    <!-- BEGIN .eleven columns -->
	    <div class="eleven columns">
	    	
	    	<div class="page content holder">
	    
		        <!-- BEGIN .article -->
		        <div class="article">
		                
		            <h1 class="headline"><?php _e("Not Found, Error 404", 'organicthemes'); ?></h1>
		            <p><?php _e("The page you are looking for no longer exists or cannot be found.", 'organicthemes'); ?></p>
		        
		        <!-- END .article -->
		        </div>
	        
	        <!-- END .post -->
	        </div>
	        
	    <!-- END .eleven columns -->
	    </div>
	            
	    <!-- BEGIN .five columns -->
	    <div class="five columns">
	    
	        <?php get_sidebar(); ?> 
	    
	    <!-- END .five columns -->
	    </div>
	
	<!-- END .row -->
	</div>

<!-- END #content -->
</div>

<?php get_footer(); ?>