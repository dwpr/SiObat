    <div>
        <p>
        <legend>Obat Herbal</legend>
        merupakan obat ....</p>
    </div> 
    <?php 
    if($this->session->userdata('level') == '1'){ ?>
      <button style="margin-bottom: 10px;" class="btn btn-primary" onclick="tambah()">Tambah Data</button>
    <?php } ?>
      <div class="panel panel-default">
                            <div class="panel-heading">
                                Daftar Obat Herbal
                            </div>
                <?php echo $this->session->flashdata("k");?>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="tabelobat">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th class="hidden">ID Obat</th>
                                                <th>Nama Tanaman</th>
                                                <th>Indikasi</th>
                                                <th>Cara Pakai</th>
                                                <?php 
                                                if($this->session->userdata('level') == '1'){ ?>                                     
                                                <th width="10%">Action</th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no=1;
                                            foreach ($obat as $obs) {
                                            ?>
                                            <tr data-toggle="tooltip" data-placement="top" title="Click untuk detail / info obat" class="odd gradeX">
                                                <td class="klik ok"><?php echo $no;?></td>
                                                <td class="klik ok hidden"><?php echo $obs->id_obat;?></td>
                                                <td class="klik ok"><?php echo $obs->nama_tanaman;?></td>
                                                <td class="klik ok"><?php echo $obs->indikasi;?></td>
                                                <td class="klik ok"><?php echo $obs->cara_pakai;?></td>
                                                <?php 
                                                if($this->session->userdata('level') == '1'){ ?> 
                                                <td>
                                                    <button data-toggle="tooltip" data-placement="top" title="Edit Obat" class="btn btn-warning" onclick="editobat(<?php echo $obs->id_obat;?>)"><span class="fa fa-edit"></span></button> <a data-toggle="tooltip" data-placement="top" title="Hapus Obat" class="btn btn-danger" onclick="return confirm('Anda YAKIN menghapus data obat  \n <?=$obs->nama_tanaman?> ... ?');" href="<?php echo base_URL('obat/herbal/delete/'.$obs->id_obat) ;?>"><span class="fa fa-remove"></span></a>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                            <?php
                                            $no++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $('#tabelobat').DataTable({
                responsive: true
    });//datatable view
</script>
<script type="text/javascript">
var table = $('.dataTable').DataTable();
    $('#tabelobat tbody').on('click','.ok', function() {
        var currentRowData = table.row(this).data();
        //alert(currentRowData[1]) // wil give you the value of this clicked row and first index (td)
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_URL('obat/herbal/getobatbyid')?>/"+currentRowData[1],
        type: "GET",
        dataType: "JSON",
        success: function(data){
            if(data.foto == "no_foto.png" || ""){
                var ff = "<?php echo base_URL('assets/img/no_foto.png')?>";
            }else{
                var ff = data.foto;
            }
            $('#info_foto').attr("src",ff);
            $('#info_foto').attr("alt","SIObat"+data.nama_tanaman);
            $('#info_namatanaman').text(data.nama_tanaman);
            $('#info_indikasi').text(data.indikasi);
            $('#info_aturan').text(data.cara_pakai);
            $('#info_keteranganobat').html(data.keterangan);
            $('#info_obat').modal('show'); // show bootstrap modal when complete loaded
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    });
</script>
<script type="text/javascript">
    var tipe; //untuk menyimpan string

function tambah(){
    tipe = 'tambah';
    $('#form')[0].reset(); // reset form on modals
    $('#modalobat').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Obat'); // Set title to Bootstrap modal title
}

//graber data obat dengan ajax untuk modal
function editobat(id){
    tipe = 'edit';
      $('#form')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo base_URL('obat/herbal/getobatbyid')?>/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            $('[name="foto"]').val(data.foto);
            $('[name="nama_tanaman"]').val(data.nama_tanaman);
            $('[name="indikasi"]').val(data.indikasi);
            $('[name="cara_pakai"]').val(data.cara_pakai);
            $('[name="keterangan"]').html(data.keterangan);//html or text karena text area tidak mempunyai attribut value seperti input txt lainnya
            $('[name="id_obat"]').val(data.id_obat);
            $('#modalobat').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Obat'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

//save from modal untuk database dengan pilihan tambah atau edit
function save(){
      var url;
      if(tipe == 'tambah'){
          url = "<?php echo base_URL('obat/herbal/tambah')?>";
      }else{
        url = "<?php echo base_URL('obat/herbal/edit')?>";
      }
      // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
                $('#modalobat').modal('hide');
                location.reload();// for reload a page
            }/*,
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }*/
        });
}

</script>
<!-- Modal ke 1 -->
                <div class="modal fade pg-show-modal" id="modalobat" tabindex="-1" role="dialog" aria-hidden="true"> 
                    <div class="modal-dialog"> 
                        <div class="modal-content"> 
                            <div class="modal-header bg-success">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Tambah Data Obat</h4> 
                            </div>
                            <div class="modal-body" id="tampil obat">
                                <form id="form" action="#" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Foto / Gambar</label>
                                        <div class="input-group igi">
                                            <input style="border-radius: 0px;" placeholder="Url gambar / foto, dapat juga upload pada tombol disamping" class="form-control" name="foto" type="text" id="fieldID">
                                            <a style="border-radius: 0px;position: absolute;" data-toggle="tooltip" data-placement="top" class="linkk btn btn-info fmanager" title="Find" href="<?=base_url('assets/filemanager/')?>dialog.php?type=1&field_id=fieldID"><span class="fa fa-search"></a>
                                        </div>
                                        <label>Nama Tanaman</label>
                                        <input placeholder="Nama Tanaman" name="nama_tanaman" type="text" class="in_g form-control" autofocus="autofocus" required>
                                        <label>Indikasi</label>
                                        <input placeholder="Indikasi sakit" name="indikasi" type="text" class="in_g form-control" required>
                                        <label>Cara Pakai</label>
                                        <input placeholder="Cara pakai obat" name="cara_pakai" type="text" class="in_g form-control" required>
                                        <label>Keterangan</label>
                                        <textarea rows="4" placeholder="Isikan keterangan tambahan jika perlu" name="keterangan" class="in_g form-control"></textarea>
                                        <input type="hidden" name="id_obat">
                                    </div>
                                    <button name="simpan" type="submit" onclick="save()" class="btn btn-primary">Simpan</button> <!--|<button type="reset" class="btn btn-danger">Reset</button>-->
                                </form>
                            </div>
                        </div>         
                    </div>     
                </div>
<!-- Modal ke 2 -->
<div class="modal fade pg-show-modal" id="info_obat" tabindex="-1" role="dialog" aria-hidden="true"> 
                    <div class="modal-dialog"> 
                        <div class="modal-content"> 
                            <div class="modal-header bg bg-info">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title ">Info Obat</h4> 
                            </div>
                            <div class="modal-body" id="tampil info_obat">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td align="center" colspan="2"><img style="height: 50%" id="info_foto" draggable='false' class='img img-responsive'></td>
                                        </tr>
                                        <tr>
                                            <td class="bg bg-success">Nama Tanaman</td>
                                            <td id="info_namatanaman">
                                        </tr>
                                        <tr>
                                            <td class="bg bg-success">Indikasi</td>
                                            <td id="info_indikasi">
                                        </tr>
                                        <tr>
                                            <td class="bg bg-success">Cara Pakai</td>
                                            <td id="info_aturan">
                                        </tr>
                                        <tr>
                                            <td class="bg bg-success">Keteranan lanjut</td>
                                            <td id="info_keteranganobat">
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>         
                    </div>     
                </div>