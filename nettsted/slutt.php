<?php $url = 'https://home.usn.no/web-is-gr10w/nettsted'; ?>
<!-- jQuery.com -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="<?php echo "$url";?>/assets/js/bootstrap.js"></script>


<!-- jQueryUI -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Det er de samma -->
<script type="text/javascript" src="assets/bootstrap/js/jquery.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/jquery-ui.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/ui.js"></script>
<!-- Dette er datepicker -->
<script>

    $( function() {
        //  Til sok.php
        $( "#fra" ).datepicker({
            dateFormat: 'yy-mm-dd',
            showButtonPanel: true
        });
        //  Til sok.php
        $( "#til" ).datepicker({
            dateFormat: 'yy-mm-dd',
            showButtonPanel: true
        });
//
//        $( "#inndato" ).datepicker({
//            dateFormat: 'yy-mm-dd',
//            showButtonPanel: true
//        });
//
//        $( "#utdato" ).datepicker({
//            dateFormat: 'yy-mm-dd',
//            showButtonPanel: true
//        });
    });
</script>
<!-- Datepicker ends :D-->
<script>
    $(document).ready(function(){
        $("#myBtn").click(function(){
            $("#myModal").modal();
        });
    });
</script>

</body>
</html>