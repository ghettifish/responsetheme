<?php 

// Custom fields for WP write panel

function organic_metabox_create() {
    global $post;
    $ot_metaboxes = get_option('ot_custom_template');     
    $output = '';
    $output .= '<table class="ot_metaboxes_table">'."\n";
    foreach ($ot_metaboxes as $ot_id => $ot_metabox) {
    if(        
            $ot_metabox['type'] == 'text' 
    OR      $ot_metabox['type'] == 'select' 
    OR      $ot_metabox['type'] == 'checkbox' 
    OR      $ot_metabox['type'] == 'textarea'
    OR      $ot_metabox['type'] == 'radio'
    OR      $ot_metabox['type'] == 'color'
    OR      $ot_metabox['type'] == 'upload'
    )
            $ot_metaboxvalue = get_post_meta($post->ID,$ot_metabox["name"],true);
            
            if ($ot_metaboxvalue == "" || !isset($ot_metaboxvalue)) {
                $ot_metaboxvalue = $ot_metabox['std'];
            }
            if($ot_metabox['type'] == 'text'){
            
                $output .= "\t".'<tr>';
                $output .= "\t\t".'<th class="ot_metabox_names"><label for="'.$ot_id.'">'.$ot_metabox['label'].'</label></th>'."\n";
                $output .= "\t\t".'<td><input class="ot_input_text" type="'.$ot_metabox['type'].'" value="'.$ot_metaboxvalue.'" name="organic_'.$ot_metabox["name"].'" id="'.$ot_id.'"/>';
                $output .= '<span class="ot_metabox_desc">'.$ot_metabox['desc'].'</span></td>'."\n";
                $output .= "\t".'<td></td></tr>'."\n";  
                              
            }
            
            elseif ($ot_metabox['type'] == 'textarea'){
            
                $output .= "\t".'<tr>';
                $output .= "\t\t".'<th class="ot_metabox_names"><label for="'.$ot_metabox.'">'.$ot_metabox['label'].'</label></th>'."\n";
                $output .= "\t\t".'<td><textarea class="ot_input_textarea" name="organic_'.$ot_metabox["name"].'" id="'.$ot_id.'">' . $ot_metaboxvalue . '</textarea>';
                $output .= '<span class="ot_metabox_desc">'.$ot_metabox['desc'].'</span></td>'."\n";
                $output .= "\t".'<td></td></tr>'."\n";  
                              
            }

            elseif ($ot_metabox['type'] == 'select'){
                       
                $output .= "\t".'<tr>';
                $output .= "\t\t".'<th class="ot_metabox_names"><label for="'.$ot_id.'">'.$ot_metabox['label'].'</label></th>'."\n";
                $output .= "\t\t".'<td><select class="ot_input_select" id="'.$ot_id.'" name="organic_'. $ot_metabox["name"] .'">';
                $output .= '<option value="">Select to return to default</option>';
                
                $array = $ot_metabox['options'];
                
                if($array){
                
                    foreach ( $array as $id => $option ) {
                        $selected = '';
                       
                                                       
                        if($ot_metabox['default'] == $option && empty($ot_metaboxvalue)){$selected = 'selected="selected"';} 
                        else  {$selected = '';}
                        
                        if($ot_metaboxvalue == $option){$selected = 'selected="selected"';}
                        else  {$selected = '';}  
                        
                        $output .= '<option value="'. $option .'" '. $selected .'>' . $option .'</option>';
                    }
                }
                
                $output .= '</select><span class="ot_metabox_desc">'.$ot_metabox['desc'].'</span></td></td><td></td>'."\n";
                $output .= "\t".'</tr>'."\n";
            }
            
            elseif ($ot_metabox['type'] == 'checkbox'){
            
                if($ot_metaboxvalue == 'true') { $checked = ' checked="checked"';} else {$checked='';}

                $output .= "\t".'<tr>';
                $output .= "\t\t".'<th class="ot_metabox_names"><label for="'.$ot_id.'">'.$ot_metabox['label'].'</label></th>'."\n";
                $output .= "\t\t".'<td><input type="checkbox" '.$checked.' class="ot_input_checkbox" value="true"  id="'.$ot_id.'" name="organic_'. $ot_metabox["name"] .'" />';
                $output .= '<span class="ot_metabox_desc" style="display:inline">'.isset($ot_metabox['desc']).'</span></td></td><td></td>'."\n";
                $output .= "\t".'</tr>'."\n";
            }
            
            elseif ($ot_metabox['type'] == 'radio'){
            
                $array = $ot_metabox['options'];
            
            if($array){
            
            $output .= "\t".'<tr>';
            $output .= "\t\t".'<th class="ot_metabox_names"><label for="'.$ot_id.'">'.$ot_metabox['label'].'</label></th>'."\n";
            $output .= "\t\t".'<td>';
            
                foreach ( $array as $id => $option ) {
                              
                    if($ot_metaboxvalue == $id) { $checked = ' checked="checked"';} else {$checked='';}

                        $output .= '<input type="radio" '.$checked.' value="' . $id . '" class="ot_input_radio"  id="'.$ot_id.'" name="organic_'. $ot_metabox["name"] .'" />';
                        $output .= '<span class="ot_input_radio_desc" style="display:inline">'. $option .'</span><div class="ot_spacer"></div>';
                    }
                    $output .=  '</td></td><td></td>'."\n";
                    $output .= "\t".'</tr>'."\n";    
                 }
            }
            
            elseif($ot_metabox['type'] == 'color'){
            
                $output .= "\t".'<tr>';
                $output .= "\t\t".'<th class="ot_metabox_names"><label for="'.$ot_id.'">'.$ot_metabox['label'].'</label></th>'."\n";
                $output .= "\t\t".'<td><input class="ot_input_color" type="text" value="'.$ot_metaboxvalue.'" name="organic_'. $ot_metabox["name"] .'" id="color"/>
                			<div id="colorpicker"></div>';
                $output .= '<span class="ot_metabox_desc">'.$ot_metabox['desc'].'</span></td>'."\n";
                $output .= "\t".'<td></td></tr>'."\n";  
                              
            }
            
            elseif($ot_metabox['type'] == 'upload')
            {
            
                $output .= "\t".'<tr>';
                $output .= "\t\t".'<th class="ot_metabox_names"><label for="'.$ot_id.'">'.$ot_metabox['label'].'</label></th>'."\n";
                $output .= "\t\t".'<td class="ot_metabox_fields">'. organic_uploader_custom_fields($post->ID,$ot_metabox["name"],$ot_metabox["default"],$ot_metabox["desc"]);
                $output .= '</td>'."\n";
                $output .= "\t".'</tr>'."\n";
                
            }
        }
    
    $output .= '</table>'."\n\n";
    echo $output;
}

function organic_uploader_custom_fields($pID,$id,$std,$desc){

    // Start Uploader
    $upload = get_post_meta( $pID, $id, true);
    $uploader .= '<input class="ot_input_text" name="'.$id.'" type="text" value="'.$upload.'" />';
    $uploader .= '<div class="clear"></div>'."\n";
    $uploader .= '<input type="file" name="attachement_'.$id.'" />';
    $uploader .= '<input type="submit" class="button button-highlighted" value="Save" name="save"/>';
    //$uploader .= '<span class="ot_metabox_desc">'.$desc.'</span></td>'."\n".'<td class="ot_metabox_image"><a href="'. $upload .'"><img src="'.$thumb.'" alt="" /></a>';

return $uploader;
}

function organic_metabox_handle(){   
    
    global $globals;
    $ot_metaboxes = get_option('ot_custom_template');     
    $pID = $_POST['post_ID'];
    $upload_tracking = array();
    
    if ($_POST['action'] == 'editpost'){                                   
        foreach ($ot_metaboxes as $ot_metabox) { // On Save.. this gets looped in the header response and saves the values submitted
            if($ot_metabox['type'] == 'text' OR $ot_metabox['type'] == 'select' OR $ot_metabox['type'] == 'radio' OR $ot_metabox['type'] == 'checkbox' OR $ot_metabox['type'] == 'textarea' OR $ot_metabox['type'] == 'color' ) // Normal Type Things...
                {
                    $var = "organic_".$ot_metabox["name"];
                    if (isset($_POST[$var])) {            
                        if( get_post_meta( $pID, $ot_metabox["name"] ) == "" )
                            add_post_meta($pID, $ot_metabox["name"], $_POST[$var], true );
                        elseif($_POST[$var] != get_post_meta($pID, $ot_metabox["name"], true))
                            update_post_meta($pID, $ot_metabox["name"], $_POST[$var]);
                        elseif($_POST[$var] == "") {
                           delete_post_meta($pID, $ot_metabox["name"], get_post_meta($pID, $ot_metabox["name"], true));
                        }
                    }
                    elseif(!isset($_POST[$var]) && $ot_metabox['type'] == 'checkbox') { 
                        update_post_meta($pID, $ot_metabox["name"], 'false'); 
                    }      
                    else {
                          delete_post_meta($pID, $ot_metabox["name"], get_post_meta($pID, $ot_metabox["name"], true)); // Deletes check boxes OR no $_POST
                    }    
                }
          
            elseif($ot_metabox['type'] == 'upload') // So, the upload inputs will do this rather
                {
                $id = $ot_metabox['name'];
                $override['action'] = 'editpost';
                    if(!empty($_FILES['attachement_'.$id]['name'])){ //New upload          
                           $uploaded_file = wp_handle_upload($_FILES['attachement_' . $id ],$override); 
                           $uploaded_file['option_name']  = $ot_metabox['label'];
                           $upload_tracking[] = $uploaded_file;
                           update_post_meta($pID, $id, $uploaded_file['url']);
                    }
                    elseif(empty( $_FILES['attachement_'.$id]['name']) && isset($_POST[ $id ])){
                        update_post_meta($pID, $id, $_POST[ $id ]); 
                    }
                    elseif(isset($_POST[ $id ]) == '')  { delete_post_meta($pID, $id, get_post_meta($pID, $id, true));
                    }
                }
               // Error Tracking - File upload was not an Image
               update_option('ot_custom_upload_tracking', $upload_tracking);
            }
        }
}

function organic_metabox_add() {
    if ( function_exists('add_meta_box') ) {
        add_meta_box('organic-settings', get_option('ot_response').'Slideshow Post Background Settings', 'organic_metabox_create', 'post', 'normal', 'high');
        //add_meta_box('organic-settings', get_option('ot_response').'Custom Background Settings', 'organic_metabox_create', 'page', 'normal');
    }
}

function organic_metabox_header(){
?>

<script type="text/javascript">

    jQuery(window).load(function() {
    	jQuery(function() {
	    	jQuery('#colorpicker').hide();
	    	jQuery('#colorpicker').farbtastic("#color");
	    	jQuery("#color").click(function(){
	    		jQuery('#colorpicker').slideToggle()
	    	});
    	});
        jQuery('form#post').attr('enctype','multipart/form-data');
        jQuery('form#post').attr('encoding','multipart/form-data');
        jQuery('.ot_metaboxes_table th:last, .ot_metaboxes_table td:last').css('border','0');
        var val = jQuery('input#title').attr('value');
        if(val == ''){ 
        jQuery('.ot_metabox_fields .button-highlighted').after("<em class='ot_red_note'>Please add a Title before uploading a file</em>");
        };
        <?php //Errors
        $error_occurred = false;
        $upload_tracking = get_option('ot_custom_upload_tracking');
        if(!empty($upload_tracking)){
        $output = '<div style="clear:both;height:20px;"></div><div class="errors"><ul>' . "\n";
            $error_shown == false;
            foreach($upload_tracking as $array )
            {
                if(array_key_exists('error', $array)){
                    $error_occurred = true;
                    ?>
                    jQuery('form#post').before('<div class="updated fade"><p>organic Upload Error: <strong><?php echo $array['option_name'] ?></strong> - <?php echo $array['error'] ?></p></div>');
                    <?php
                }
            }
        }
        delete_option('ot_upload_custom_errors');
        ?>
    });

</script>

<style type="text/css">
input#background_color {
	width: 68px;
	}
.ot_input_text { margin:0 0 10px 0; background:#f4f4f4; color:#444; width:80%; font-size:11px; padding: 5px;}
.ot_input_select { margin:0 0 10px 0; background:#f4f4f4; color:#444; width:60%; font-size:11px; padding: 5px;}
.ot_input_checkbox { margin:0 10px 0 0; }
.ot_input_radio { margin:0 10px 0 0 !important; }
.ot_input_radio_desc { font-size: 12px; color: #666 ; }
.ot_spacer { display: block; height:5px}
.ot_metabox_desc { font-size:11px; color:#999; margin-top: 8px; display:block}
.ot_metaboxes_table{ border-collapse:collapse; width:100%}
.ot_metaboxes_table tr:hover th,
.ot_metaboxes_table tr:hover td { background:#f8f8f8}
.ot_metaboxes_table th,
.ot_metaboxes_table td{ padding:10px 10px;text-align: left; vertical-align:top}
.ot_metabox_names { width:20%}
.ot_metabox_fields { width:70%}
.ot_metabox_image { text-align: right;}
.ot_red_note { margin-left: 5px; color: #c77; font-size: 10px;}
.ot_input_textarea { width:80%; height:120px;margin:0 0 10px 0; background:#f0f0f0; color:#444;font-size:11px;padding: 5px;}
</style>
<?php
}
add_action('edit_post', 'organic_metabox_handle');
add_action('admin_menu', 'organic_metabox_add'); // Triggers organic_metabox_create
add_action('admin_head', 'organic_metabox_header');