<!--========================= Content Wrapper ==============================-->
<div class="container">
<div class="container">
    <h1 class="text-info" style="text-align: center"><img src="<?php echo base_url();?>asset/img/logo.png"/></h1>
    <br/>
    <h1 class="text-info" style="text-align: center">Pembukuan Cool Zee</h1>
    <br/>

<?php if(isset($dt_contact)){
foreach($dt_contact as $row){
?>
    <div class="row well" style="text-align: center">
        <h3><?php echo $row->nama?></h3>
        <h4><?php echo $row->desc?></h4>
        <h5 class="muted"><?php echo $row->alamat?></h5>
        <h5 class="muted"><?php echo $row->email?> || <?php echo $row->telp?> || <?php echo $row->website?></h5>

    </div>
<?php }
}
?>
</div>


