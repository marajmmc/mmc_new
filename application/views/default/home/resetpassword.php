<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
    $CI=& get_instance();

?>
<div id="system_content" class="system_content_margin">
 
    <form id="resetpassword_form" action="<?php echo $CI->get_encoded_url('home/resetpassword'); ?>" method="post">
        

	         
			
				<div class="control-group">
					<label for="email"> Email</label>
					<input class="box" type="text" id="email" name="email" />
				</div>
				
					<input type="submit" class="btn btn-primary" value="Reset" />
				
				
				
			
		</form>
</div> 