<!-- THE MESSAGES -->
<?php
if(!empty($emails)): ?>
<table class="table table-mailbox">
    <?php
    foreach($emails as $email):?>
    <tr>
        <td class="small-col"><input type="checkbox" value="<?php echo $email->email_id;?>" /></td>
        <td class="name"><a href="<?php echo site_url('sk-admin/contact/view_email/'.$email->email_id);?>"><?php echo $email->email_to;?></a></td>
        <td class="subject"><a href="<?php echo site_url('sk-admin/contact/view_email/'.$email->email_id);?>"><?php echo htmlspecialchars_decode(word_limiter($email->content,5));?></a></td>
        <td class="time"><?php echo dateindo($email->date);?></td>
    </tr>
    <?php endforeach;
    else:
        echo '<tr class="read">No data found</tr>';
    endif; ?>                                                       
</table>