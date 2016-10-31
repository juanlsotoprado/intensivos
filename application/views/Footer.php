<br>

</div>

<!-- /.row -->
</div>
<!-- /#page-wrapper -->

<div class="col-lg-12" style="padding-left: 0px;padding-right: 0px;">
    <section  class="footer" style="border-top: 1px solid #e7e7e7">

        <h4 class="footer-title-ministerio">
            <br>Ministerio del Poder Popular
            para Educación Universitaria, Ciencia y Tecnología&nbsp; <em style="font-size: 10px;">Copyleft © 2016 MPPEUCT - RIF: G-20011296-4</em></h4>
        <br>
    </section>

</div>

</div>
<!-- /#wrapper -->





<script src="<?php echo base_url('publico/plugins/jquery/dist/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('publico/plugins/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>


<script src="<?php echo base_url('publico/plugins/jAlert-master/src/jAlert-v3.js'); ?>"></script>
<script src="<?php echo base_url('publico/plugins/angular.min.js'); ?>"></script>
<script src="<?php echo base_url('publico/plugins/angular-sanitize.min.js'); ?>"></script>
<script src="<?php echo base_url('publico/plugins/ngprogress-lite-master/ngprogress-lite.min.js'); ?>"></script>


<script src="<?php echo base_url('publico/plugins/angular-route.min.js'); ?>"></script>
<script src="<?php echo base_url('publico/plugins/angular-locale_es-es.js'); ?>"></script>
<script src="<?php echo base_url('publico/plugins/angular-animate.js'); ?>"></script>
<script src="<?php echo base_url('publico/plugins/jquery.dropdown.js'); ?>"></script>


<script type="text/javascript" charset="utf8" src="<?php echo base_url('publico/js/jquery.dataTables.js'); ?>"></script>

<script data-require="angular-datatable.js@1.1.5" data-semver="1.1.5" src="<?php echo base_url('publico/js/angular-datatables.min.js'); ?>"></script>

<script src="<?php echo base_url('publico/js/moment-with-locales.js'); ?>"type="text/javascript"></script>
<script src="<?php echo base_url('publico/js/bootstrap-datetimepicker.js'); ?>"type="text/javascript"></script>

<script src="<?php echo base_url('publico/js/fileinput.js'); ?>"type="text/javascript"></script>
<script src="<?php echo base_url('publico/js/fileinput_locale_es.js'); ?>"type="text/javascript"></script>

<script src="<?php echo base_url('publico/plugins/metisMenu/dist/metisMenu.min.js'); ?>"></script>
<script src="<?php echo base_url('publico/js/sb-admin-2.js'); ?>"></script>


<script>
    var base_url = "<?php echo base_url(); ?>";
    var id_perfil = <?php echo $user_sesion['id_perfil']; ?>;
</script>
 <?php if($user_sesion['id_perfil'] == 4){ ?>

<script>
    var postulado = <?php echo $user_sesion['postulado']? $user_sesion['postulado'] : 'false'; ?>;
</script>
 <?php }?>


<script src="<?php echo base_url('publico/js/js-app/home.js'); ?>"type="text/javascript"></script>

</body>

</html>
