<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$id = $this->session->flashdata('id');
$isi = $this->session->flashdata('pesan');

if($id === 'berhasil')
{
    ?>
    <script>
    $('.notif').text('<?php echo $isi ?>');
    $('.notif').css('background','#007BFF');
    $('.notif').animate(
    {
        top:"100px",
        opacity:"0.9"
    },700);
    
    setTimeout(function()
    {
        $('.notif').animate(
        {
            top:"-100px",
            opacity:"0"
        },900);
    },4000);
    </script>
    <?php
}
if($id === 'gagal')
{
    ?>
    <script>
    $('.notif').text('<?php echo $isi ?>');
    $('.notif').css('background','#DC3545');
    $('.notif').animate(
    {
        top:"100px",
        opacity:"0.9"
    },700);
    
    setTimeout(function()
    {
        $('.notif').animate(
        {
            top:"-100px",
            opacity:"0"
        },900);
    },4000);
    </script>
    <?php
}
if($id === 'id')
{
    ?>
    <script>
    $('.notif').text('<?php echo $isi ?>');
    $('.notif').css('background','#DC3545');
    $('.notif').animate(
    {
        top:"100px",
        opacity:"0.9"
    },700);
    
    setTimeout(function()
    {
        $('.notif').animate(
        {
            top:"-100px",
            opacity:"0"
        },900);
    },4000);
    </script>
    <?php
}

