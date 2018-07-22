

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo site_url('assets/js/sb-admin-2.js')?>"></script>

    <script type="text/javascript">
    display_session();
    function display_session()
    {
        $.ajax(
        {
            url   : '<?php echo base_url()?>index.php/dashboard/page/display_session',
            type  : 'ajax',
            dataType : 'json',
            success : function(data)
            {
                $('img#nav-photo').attr('src','<?php echo site_url('assets/img/')?>'+data.photo);
                $('b#nav-nama').text(data.nama_pengguna);
                $('text#nav-email').text(data.email);
            }
        });
    }
    </script>