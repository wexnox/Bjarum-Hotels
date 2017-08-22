<?php
//$url = 'https://home.usn.no/web-is-gr10w/vedlikehold';
$url = 'http://192.168.0.109/phpeksamen/vedlikehold/';
?>
<!-- jQuery.com -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="<?php echo "$url";?>/assets/js/jquery-3.1.1.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!--<script src="--><?php //echo "$url";?><!--/assets/js/bootstrap.js"></script>-->


<!-- jQueryUI -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
        $( "#check_in" ).datepicker({
            dateFormat: 'yy-mm-dd',
            showButtonPanel: true
        });
        $( "#check_out" ).datepicker({
            dateFormat: 'yy-mm-dd',
            showButtonPanel: true
        });
        $( "#inndato" ).datepicker({
            dateFormat: 'yy-mm-dd',
            showButtonPanel: true
        });
        $( "#utdato" ).datepicker({
            dateFormat: 'yy-mm-dd',
            showButtonPanel: true
        });
    });
</script>

</body>
</html>