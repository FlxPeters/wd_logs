
<div id="tl_logs" style="margin-top: 25px;">

    <h2 class="sub_headline">
        <?php echo $this->errorHeadline; ?>
    </h2>
	
	<?php if($this->errorLog): ?>
	<div class="tl_listing_container list_view">
	    <table cellspacing="0" cellpadding="0" summary="Table lists records" class="tl_listing">
	        <tbody>
	        	<?php foreach ($this->errorLog as $k => $logs) : ?>
				
	            <tr>
	                <td class="tl_folder_tlist" colspan="2">
	                    <? echo $k; ?>
	                </td>
	            </tr>
				<?php foreach ($logs as $log) : ?>
	            <tr>
	                <td class="tl_file_list" style="">
	                    <span style="color:#b3b3b3; padding-right:3px;">[<?php echo $log['datim']; ?>]</span>
	                    <span class="<?php echo $log['class']; ?>"><?php echo $log['text']; ?></span>
	                </td>                
	            </tr>
				<?php endforeach; ?>
				<? endforeach; ?>
	        </tbody>
	    </table>
	</div>
	<?php else: ?>
	<p style="margin-left: 20px;">Kein Logfile vorhanden</p>
	<?php endif; ?>
	<h2 class="sub_headline">
	    <?php echo $this->emailHeadline; ?>
	</h2>
	<?php if($this->emailLog): ?>
	<div class="tl_listing_container list_view">
	    <table cellspacing="0" cellpadding="0" summary="Table lists records" class="tl_listing">
	        <tbody>
	        	<?php foreach ($this->emailLog as $k => $logs) : ?>
				
	            <tr>
	                <td class="tl_folder_tlist" colspan="2">
	                    <? echo $k; ?>
	                </td>
	            </tr>
				<?php foreach ($logs as $log) : ?>
	            <tr>
	                <td class="tl_file_list" style="">
	                    <span style="color:#b3b3b3; padding-right:3px;">[<?php echo $log['datim']; ?>]</span>
	                    <span class="<?php echo $log['class']; ?>"><?php echo $log['text']; ?></span>
	                </td>                
	            </tr>
				<?php endforeach; ?>
				<? endforeach; ?>
	        </tbody>
	    </table>
	</div>
	<?php else: ?>
	<p style="margin-left: 20px;"><?php echo $GLOBALS['TL_LANG']['MSC']['noFile'] ?></p>
	<?php endif; ?>

</div>