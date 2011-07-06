<div id="tl_buttons">
    <a href="<?php echo $this->href; ?>" class="header_back" title="<?php echo $this->title; ?>">
        <?php echo $this->button; ?>
    </a>
</div>
<div id="tl_logs">
    <h2 class="sub_headline">
        <?php echo $this->errorHeadline; ?>
    </h2>
</div>
<div class="tl_listing_container list_view">
    <table cellspacing="0" cellpadding="0" summary="Table lists records" class="tl_listing">
        <tbody>
        	<?php foreach($this->errorLog as $k => $logs): ?>
			
            <tr>
                <td class="tl_folder_tlist" colspan="2">
                    <? echo $k; ?>
                </td>
            </tr>
			<?php foreach($logs as $log): ?>
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