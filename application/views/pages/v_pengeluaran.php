   <!-- css for date picker --> 
<link rel="stylesheet" href="<?php echo base_url(); ?>lib/jquery-ui-1.10.0/development-bundle/themes/base/jquery.ui.all.css" />

<script src="<?php echo base_url(); ?>lib/jquery-ui-1.10.0/development-bundle/ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url(); ?>lib/jquery-ui-1.10.0/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="<?php echo base_url(); ?>lib/jquery-ui-1.10.0/development-bundle/ui/jquery.ui.position.js"></script>
<script src="<?php echo base_url(); ?>lib/jquery-ui-1.10.0/development-bundle/ui/jquery.ui.menu.js"></script>
<script src="<?php echo base_url(); ?>lib/jquery-ui-1.10.0/development-bundle/ui/jquery.ui.autocomplete.js"></script>
<script src="<?php echo base_url(); ?>lib/jquery-ui-1.10.0/development-bundle/ui/jquery.ui.datepicker.js"></script>

<!--================ Content Wrapper===========================================-->
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Kode Pengeluaran</th>
        <th>Nama Items/Barang</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th class="span3">
            <a href="#modalAddpengbarang" class="btn btn-mini btn-block btn-inverse" data-toggle="modal">
                <i class="icon-plus-sign icon-white"></i> Tambah Data
            </a>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
    $no=1;
    if(isset($data_pengeluaran)){
        foreach($data_pengeluaran as $row){
            ?>
            <tr class="gradeX">
                <td><?php echo $no++; ?></td>
                <td><?php echo date("d M Y",strtotime($row->tgl)); ?></td>
                <td><?php echo $row->id; ?></td>
                <td><?php echo $row->nama; ?></td>
                <td><?php echo $row->jumlah; ?> Items</td>
                <td><?php echo currency_format($row->harga); ?></td>
                <td>
                    <a class="btn btn-mini" href="#modaleditpenge<?php echo $row->id?>" 
                    data-toggle="modal"><i class="icon-pencil"></i> Edit</a>
                    <a class="btn btn-mini" href="<?php echo site_url('master/hpspengbrg/'.$row->id);?>"
                    onclick="return confirm('Anda yakin?')"> <i class="icon-remove"></i> Hapus</a>
                </td>
            </tr>
        <?php }
    }
    ?>

    </tbody>
</table>

<!-- ============ MODAL ADD DATA PENGELUARAN =============== -->
<div id="modalAddpengbarang" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Tambah Data Barang Pengeluarang</h3>
    </div>
    <form class="form-horizontal" method="post" action="<?php echo site_url('master/tambahdtpenge')?>">
        <div class="modal-body">
            <div class="control-group">
                <label class="control-label">Kode Barang</label>
                <div class="controls">
                    <input name="idbarang" id="idbarang" type="text" value="" placeholder="Kode Barang">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" >Nama Barang</label>
                <div class="controls">
                    <input name="nm_barang" id="nm_barang" type="text" placeholder="Input Nama Barang...">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" >Jumlah</label>
                <div class="controls">
                    <input name="jlh" id="jlh" type="text" placeholder="Input Jumlah..." value="0">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Harga</label>
                <div class="controls">
                    <input name="harga" id="harga" type="text" placeholder="Input Harga..." value="0">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Tgl Pengeluaran</label>
                <div class="controls">
                    <input name="tglpeng" id="tglpeng" type="text"  value="<?php echo date('d-m-Y');?>">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>


<!-- ============ MODAL EDIT BARANG PENGELUARAN =============== -->
<?php
if (isset($data_pengeluaran)){
    foreach($data_pengeluaran as $row){
        ?>
        <div id="modaleditpenge<?php echo $row->id?>" class="modal hide fade" tabindex="-1" role="dialog" 
        aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Edit Data Barang Pengeluaran</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo site_url('pengeluaran/editbarangpeng')?>">
                <div class="modal-body">
                    <div class="control-group">
                        <label class="control-label">Id Barang</label>
                        <div class="controls">
                            <input name="idbrgupd" id="idbrgupd" type="text" value="<?php echo $row->id;?>" readonly>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" >Nama Barang</label>
                        <div class="controls">
                            <input name="nm_barangupd" id="nm_barangupd" type="text" value="<?php echo $row->nama;?>" >
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" >Jumlah</label>
                        <div class="controls">
                            <input name="jlhedit" id="jlhedit" type="text" value="<?php echo $row->jumlah;?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" >Harga</label>
                        <div class="controls">
                            <input name="hrgedit" id="hrgedit" type="text" value="<?php echo $row->harga;?>">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" >Tgl Pengeluaran</label>
                        <div class="controls">
                            <input name="tgledit" id="tgledit" type="text" value="<?php echo viewtglweb($row->tgl);?>">
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
            $('#btncetak').click(function(){
                //$('.form-actions').html(''); 
                var id=$(this).val(); 
                var wind=window.open('penjualan/detail_penjualan1/'+id); 
                wind.print(); 
                wind.focus(); 
            }); 

                    $(document).on( 'click', "input#tgledit",function(){
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
        $(document).on( 'click', "input#tglpeng",function(){
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

    }); 
</script>




