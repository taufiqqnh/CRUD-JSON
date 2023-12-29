<table id="datamahasiswa" class="table table-sm table-striped" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Tempat Lahir</th>
            <th>Tgl. Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 0;
        foreach ($tampildata as $row) :
            $nomor++;
        ?>
            <tr>
                <td><?= $nomor ?></td>
                <td><?= $row['nim'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['tmplahir'] ?></td>
                <td><?= $row['tgllahir'] ?></td>
                <td><?= $row['jenkel'] ?></td>
                <td>
                    <div class="form-button-action">
                        <button type="button" data-toggle="modal" class="btn btn-warning" onclick="edit('<?= $row['nim'] ?>')">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" data-toggle="modal" class="btn btn-danger" onclick="hapus('<?= $row['nim'] ?>')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>

        <?php endforeach ?>
    </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#datamahasiswa').DataTable();
    });

    function edit(nim) {
        $.ajax({
            type: "post",
            url: "<?= site_url('mahasiswa/formedit') ?>",
            data: {
                nim: nim
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal('show');
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" +
                    thrownError);
            }
        });
    }

    function hapus(nim) {
        Swal.fire({
            title: "Hapus",
            text: `Yakin Menghapus data Mahasiswa dengan nim ${nim} ?`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= site_url('mahasiswa/hapus') ?>",
                    data: {
                        nim: nim
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil",
                                text: response.sukses,
                            });
                            datamahasiswa();
                        }

                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" +
                            thrownError);
                    }
                });
            }
        });
    }
</script>