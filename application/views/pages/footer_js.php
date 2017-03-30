<script src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/jquery.js"></script>
<script src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/sweetalert.min.js"></script>
<script src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/jquery.select2/select2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/fuelux/loader.min.js"></script>	
<script src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/modernizr.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/jquery.nanoscroller/jquery.nanoscroller.js"></script>

<script type="text/javascript" src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/jquery.nestable/jquery.nestable.js"></script>
<script type="text/javascript" src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/jquery.icheck/icheck.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/behaviour/general.js"></script>
<script type="text/javascript" src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/bootstrap.switch/bootstrap-switch.min.js"></script>
<script src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/jquery.ui/jquery-ui.js" type="text/javascript"></script>
<script type="text/javascript">
    $("#credit_slider").slider().on("slide", function(e) {
        $("#credits").html("$" + e.value);
    });
    $("#rate_slider").slider().on("slide", function(e) {
        $("#rate").html(e.value + "%");
    });
</script>
 <script type="text/javascript" src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/jquery.niftymodals/js/jquery.modalEffects.js"></script>  
<script type="text/javascript">
    $(document).ready(function() {
        //initialize the javascript
        App.init();
        App.wizard();
    });
</script>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/behaviour/voice-commands.js"></script>
<script src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(PUBLIC_URL_PATH) ?>/js/bootstrap.summernote/dist/summernote.min.js"></script>
