<!-- THE MESSAGES -->
<?php
if(!empty($messages)): ?>
<table class="table table-mailbox">
    <?php
    foreach($messages as $msg):?>
    <tr class="<?php echo $msg->status;?>">
        <td class="small-col"><input type="checkbox" value="<?php echo $msg->message_id;?>" /></td>
        <td class="name"><a href="<?php echo site_url('sk-admin/contact/view/'.$msg->message_id);?>"><?php echo $msg->name;?></a></td>
        <td class="subject"><a href="<?php echo site_url('sk-admin/contact/view/'.$msg->message_id);?>"><?php echo word_limiter($msg->message,5);?></a></td>
        <td class="time"><?php echo dateindo($msg->date);?></td>
    </tr>
    <?php endforeach;
    else:
        echo '<tr class="read">No data found</tr>';
    endif; ?>                                                       
</table>