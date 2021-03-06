   <!-- css for date picker --> 
<link rel="stylesheet" href="<?php echo base_url(); ?>lib/jquery-ui-1.10.0/development-bundle/themes/base/jquery.ui.all.css" />

<script src="<?php echo base_url(); ?>lib/jquery-ui-1.10.0/development-bundle/ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url(); ?>lib/jquery-ui-1.10.0/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="<?php echo base_url(); ?>lib/jquery-ui-1.10.0/development-bundle/ui/jquery.ui.position.js"></script>
<script src="<?php echo base_url(); ?>lib/jquery-ui-1.10.0/development-bundle/ui/jquery.ui.menu.js"></script>
<script src="<?php echo base_url(); ?>lib/jquery-ui-1.10.0/development-bundle/ui/jquery.ui.autocomplete.js"></script>
<script src="<?php echo base_url(); ?>lib/jquery-ui-1.10.0/development-bundle/ui/jquery.ui.datepicker.js"></script>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Stok</th>
        <th>Harga</th>
        <th>Tgl Masuk</th>
        <th class="span2">
            <a href="#modalAddBarang" class="btn btn-mini btn-block btn-inverse" data-toggle="modal">
                <i class="icon-plus-sign icon-white"></i> Tambah Data
            </a>
        </th>
    </tr>
    </thead>
    <tbody>

    <?php
    $no=1;
    if(isset($data_barang)){
    foreach($data_barang as $row){
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $row->kd_barang; ?></td>
        <td><?php echo $row->nm_barang; ?></td>
        <td><?php echo $row->stok; ?></td>
        <td><?php echo currency_format($row->harga);?></td>
        <td><?php 
        if(empty($row->tgl_masuk)){
            echo ''; 
        }else{
        echo viewtglweb($row->tgl_masuk);
        }
        ?></td>
        <td>
            <a class="btn btn-mini" href="#modalEditBarang<?php echo $row->kd_barang?>" 
            data-toggle="modal"><i class="icon-pencil"></i> Edit</a>
            <a class="btn btn-mini" href="<?php echo site_url('master/hapus_barang/'.$row->kd_barang);?>"
               onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a>
        </td>
    </tr>

    <?php }
    }
    ?>

    </tbody>
</table>


<!-- ============ MODAL ADD BARANG =============== -->
<div id="modalAddBarang" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Tambah Data Barang</h3>
    </div>
    <form class="form-horizontal" method="post" action="<?php echo site_url('master/tambah_barang')?>">
        <div class="modal-body">
            <div class="control-group">
                <label class="control-label">Kode Barang</label>
                <div class="controls">
                    <input name="kd_barang" type="text" value="<?php echo $kd_barang; ?>" >
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" >Nama Barang</label>
                <div class="controls">
                    <input name="nm_barang" type="text" placeholder="Input Nama Barang...">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" >Stok</label>
                <div class="controls">
                    <input name="stok" type="text" placeholder="Input Stok...">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Harga</label>
                <div class="controls">
                    <input name="harga" type="text" placeholder="Input Harga...">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Tgl Masuk</label>
                <div class="controls">
                    <input name="tglbaru" id="tglbaru" type="text" placeholder="Input Harga..." value="<?php echo date('d-m-Y');?>">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>

<!-- ============ MODAL EDIT BARANG =============== -->
<?php
if (isset($data_barang)){
    foreach($data_barang as $row){
        ?>
        <div id="modalEditBarang<?php echo $row->kd_barang?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Edit Data Barang</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('master/edit_barang')?>">
                <div class="modal-body">
                    <div class="control-group">
                        <label class="control-label">Kode Barang</label>
                        <div class="controls">
                            <input name="kd_barang" type="text" value="<?php echo $row->kd_barang;?>" readonly>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" >Nama Barang</label>
                        <div class="controls">
                            <input name="nm_barang" type="text" value="<?php echo $row->nm_barang;?>" >
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" >Stok</label>
                        <div class="controls">
                            <input name="stok" type="text" value="<?php echo $row->stok;?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Harga</label>
                        <div class="controls">
                            <input name="harga" type="text" value="<?php echo $row->harga;?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Tgl Masuk</label>
                        <div class="controls">
                            <input name="tglmasuk" id="tglmasuk" type="text" value="<?php echo $row->tgl_masuk;?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    <?php }
}
?>

<script type="text/javascript">
    $(function(){
    $(document).on( 'click', "input#tglbaru",function(){
        $(this).datepicker({
            dateFormat:"dd-mm-yy",
            showOn:'focus',
            changeMonth:true,
            changeYear:true,
            defaultDate:'-40y+0d',
            yearRange: "-100:+0"
        }).focus();
        
    });
    });
    $(function(){
        $(document).on( 'click', "input#tglmasuk",function(){
        $(this).datepicker({
            dateFormat:"dd-mm-yy",
            showOn:'focus',
            changeMonth:true,
            changeYear:true,
            defaultDate:'-40y+0d',
            yearRange: "-100:+0"
        }).focus();
        
    });
    }); 

</script>