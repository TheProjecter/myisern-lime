<?php
/*
 * Created on Nov 26, 2007
 *
 * IsernWeb, Developed by Kevin English for ICS 613
 */
?>
<?php if ($sf_request->hasErrors()): ?>  
  <div id="errors" style="padding:10px;">
    Please correct the following errors and resubmit:
    <ul>
    <?php foreach ($sf_request->getErrors() as $error): ?>
      <li><?php echo $error ?></li>
    <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<?php echo form_tag('user/login') ?>

  Welcome to IsernWeb. <br />
  Please login.
 <table>
<tbody>
<tr>
  <th>Login:</th>
  <td><?php echo input_tag('login', $sf_params->get('login')) ?></td>
</tr>
<tr>
  <th>Password:</th>
  <td><?php echo input_password_tag('password') ?></td>
</tr>
<tr>
  <td colspan=2>  <?php echo input_hidden_tag('referer', $sf_request->getAttribute('referer')) ?>
  <?php echo submit_tag('Sign In') ?></td>
</tr>
 

</tbody>
</table>  
  

 
  
 

</form>
 