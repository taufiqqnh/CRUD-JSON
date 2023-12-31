<?= $this->extend('layout/main') ?>
<?= $this->extend('layout/menu') ?>
<?= $this->section('isi') ?>

<!-- DataTables -->
<link href="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<script src="<?= base_url() ?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="col-sm-12">
    <div class="page-title-box">
        
    </div>
</div>
<div class="col-sm-12">
    <div class="card m-b-30">
        <div class="card-header">
        <h4 class="page-title">Data Mahasiswa</h4>
            <div class="d-flex ">
                <button type="button" data-toggle="modal" class="btn btn-primary btn-sm tomboltambah">
                    <i class="fa fa-edit"></i> Tambah Data
                </button>
            </div>
        </div>
        <div class="card-body">

            <p class="card-text viewdata">

            </p>
        </div>
    </div>
</div>
<div class="viewmodal" style="display: none;"></div>

<script>
    function datamahasiswa() {
        $.ajax({
            url: "<?= site_url('mahasiswa/ambildata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" +
                    thrownError);
            }
        });
    }

    $(document).ready(function() {
        // $('#datamahasiswa').DataTable();
        datamahasiswa();

        $('.tomboltambah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('mahasiswa/formtambah') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();

                    $('#modaltambah').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" +
                        thrownError);
                }
            })
        });
    });


</script>
<?= $this->endSection('') ?>