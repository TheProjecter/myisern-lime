<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>
<div id='header'>
             <ul class='menu'>

                        <li><?php echo link_to('Researchers', 'researcher/list') ?> </li>
                        <li><?php echo link_to('Organizations', 'organization/list') ?> </li>
                        <li><?php echo link_to('Collaborations', 'collaboration/list') ?></li>
                        <li><?php echo link_to('Logout', 'user/logout') ?></li>                        
                </ul>
</div>

<?php echo $sf_data->getRaw('sf_content') ?>

</body>
</html>
