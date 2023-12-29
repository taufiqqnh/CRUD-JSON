<?= $this->extend('layout/main') ?>
<?= $this->section('menu') ?>
<li class="has-submenu">
    <a href="<?= site_url('/') ?>"><i class="mdi mdi-airplay"></i>Dashboard</a>
</li>
<li class="has-submenu">
    <a href="<?= site_url('mahasiswa') ?>"><i class="mdi mdi-airplay"></i>Mahasiswa</a>
</li>
<?= $this->endSection('') ?>