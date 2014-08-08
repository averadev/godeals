
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <title>TITULO AQUI</title>
        <link href='http://fonts.googleapis.com/css?family=Gilda+Display' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url().CSS; ?>app/home.css" />
    </head>
    <body>
        
        <?php $this->load->view('app/vwHeader'); ?>
        <br/>
        ----------------
        <br/><br/>
        <div id="message"></div>
        <br/><br/>
        ----------------
        <br/>
         <?php $this->load->view('app/vwFooter'); ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url().JS; ?>app/home.js"></script>
    </body>
</html>