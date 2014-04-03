<?php
//If the form is submitted
if(isset($_POST['submit'])) {

    //Check to make sure that the name field is not empty
    if(trim($_POST['name']) == '') {
        $hasError = true;
    } else {
        $name = trim($_POST['name']);
    }

    //Check to make sure sure that a valid email address is submitted
    if(trim($_POST['email']) == '')  {
        $hasError = true;
    } else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
        $hasError = true;
    } else {
        $email = trim($_POST['email']);
    }

    //Check to make sure comments were entered
    if(trim($_POST['comments']) == '') {
        $hasError = true;
    } else {
        if(function_exists('stripslashes')) {
            $comments = stripslashes(trim($_POST['comments']));
        } else {
            $comments = trim($_POST['comments']);
        }
    }

    if(trim($_POST['subject']) == '') {
        $subject = "Formular de contact addconcept.ro";
    } else {
        $subject = trim($_POST['subject']);
    }
    //If there is no error, send the email
    if(!isset($hasError)) {
        $emailTo = 'office@addconcept.ro'; //Put your own email address here
        $body = "Nume: $name \n\nEmail: $email \n\nMesaj:\n $comments";
        $headers = "From: $email" . "\r\n" . 'Reply-To: ' . $email;

        mail($emailTo, $subject, $body, $headers);
        $emailSent = true;
    }
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!-- FancyBox -->
        <link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/grid.css">
        <link rel="stylesheet" href="css/fonts.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body class="page2">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div id="wrapper">
            <header>
                <div class="sticky-nav">
                    <a id="mobile-nav" class="menu-nav" href="#menu-nav"></a>
                    <div id="logo">
                        <a id="goUp" href="index.html" title="AddConcept">AddConcept</a>
                    </div>
                    <nav id="menu">
                        <ul id="menu-nav">
                            <li><a href="index.html">Acasa</a></li>
                            <li><a href="portofoliu.html">Portofoliu</a></li>
                            <li><a href="servicii.html">Servicii</a></li>
                            <li><a href="certificari.html">Certificari</a></li>
                            <li class="current"><a href="contact.php">Contact</a></li>
                        </ul>
                    </nav>
                </div>
            </header>

            <!-- Our Work Section -->
            <div>
                <div class="page_container2">
                    <!-- Title Page -->
                    <div class="row">
                        <div class="span12">
                            <div class="title-page">
                                <h2 class="title">Unde ne puteti gasi</h2>
                            </div>
                        </div>
                    </div>
                    <!-- End Title Page -->
                    <div class="row">
                        <div class="span12">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2732.1851920236504!2d23.590088599999994!3d46.7809551!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47490ea3d5e61f75%3A0x29927a87499054b4!2sStrada+Decebal!5e0!3m2!1sen!2s!4v1396161822094" width="910" height="300" frameborder="0" style="border:0;  margin:0 auto;"></iframe>

                            <div class="secondNavCustom">
                                <p class="spacer">&nbsp;</p>
                                <div class="row">
                                    <div class="span6">
                                        <p class="marginLR10p"><b>Adrian Petrus</b> - manager <br />&nbsp;&nbsp;&nbsp;&nbsp;tel: 0040 745 234499 <br />&nbsp;&nbsp;&nbsp;&nbsp;email: a.petrus@addconcept.ro</p>
                                    </div>
                                    <div class="span6">
                                        <p class="marginLR10p"><b>Dragoș Sergiu</b> - inginer<br />&nbsp;&nbsp;&nbsp;&nbsp;tel: 0040 742 987519<br />&nbsp;&nbsp;&nbsp;&nbsp;email: s.dragos@addconcept.ro</p>
                                    </div>
                                </div>


                                <p class="spacer">&nbsp;</p>
                                <?php if(isset($hasError)) { //If errors are found ?>
                                    <p class="spacer">&nbsp;</p>
                                    <p class="error"><b>Eroare!</b></p>
                                    <p class="error">Va rugam sa verificati corectitudinea informatiilor din fiecare camp obligatoriu al formularului. Va multumim!</p>
                                    <p class="spacer">&nbsp;</p>
                                <?php } ?>
                                <?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
                                    <p class="spacer">&nbsp;</p>
                                    <p><b>Mesajul a fost trimis cu succes!</b></p>
                                    <p>Multumim <b><?php echo $name;?></b> pentru mesajul tau! Vom reveni cu un raspuns in cel mai scurt timp posibil.</p>
                                    <p class="spacer">&nbsp;</p>
                                <?php } ?>
                                <form id="contact-form" class="contact-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <input type="text" name="name" placeholder="nume:" />
                                    <input type="text" name="email" placeholder="email:" />
                                    <input type="text" name="subject" placeholder="subiect:" />
                                    <div class="cf"></div>
                                    <textarea placeholder="mesaj:" name="comments" rows="3"></textarea>
                                    <input type="submit" name="submit" value="Trimite email" />
                                </form>
                                <p class="spacer">&nbsp;</p>
                                <p class="marginLR10p"><b>SC ADDCONCEPT SRL</b></p>
                                <p class="marginLR10p">Numarul in Registrul Comertului  J12/718/2008; Codul Unic de Identificare  RO 23327290</p>
                                <p class="marginLR10p">Sediu social: Str Padin 14/41 Cluj-Napoca</p>
                                <p class="marginLR10p">Cont: RO12BTRL01301202K51563XX Banca Transilvania</p>
                                <p class="marginLR10p">Capital social: 200 RON</p>
                                <p class="spacer">&nbsp;</p>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- End Our Work Section -->

            <div class="push"></div>
        </div><!-- /#wrapper -->

        <footer>
            <p><span class="displayBlock left">&copy;<span id="currentYear"></span> AddConcept. Toate drepturile rezervate</span><span class="displayBlock right">Design by <a href="http://www.inadcod.com/" title="inadcodDesign | Web Design &amp; Front-end Development">inadcodDesign</a></span></p>
            <div class="cf"></div>
        </footer>

        <!-- Back To Top -->
        <a id="back-to-top" href="#">
            <i class="font-icon-arrow-simple-up"></i>
        </a>
        <!-- End Back to Top -->

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>

        <script src="js/waypoints.js"></script> <!-- WayPoints -->
        <script src="js/waypoints-sticky.js"></script> <!-- Waypoints for Header -->
        <script src="js/plugins.js"></script>
        <script src="js/scripts.js"></script>


    </body>
</html>
