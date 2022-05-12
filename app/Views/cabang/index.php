<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <a href="/cabang/create" class="btn btn-primary mt-3">Tambah Cabang</a>
    <div class="row">
        <div class="col mb-3">
            <h3 class="mt-3">Daftar Cabang</h3>
            <form action="/cabang" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari cabang..." name="keyword">
                    <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php endif; ?>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (6 * ($currentPage - 1)); ?>
                    <?php foreach ($cabang as $c) : ?>
                        <tr>
                            <th scope="row" class="align-middle"><?= $i++; ?></th>
                            <td class="align-middle"><?= $c['alamat']; ?></td>
                            <td class="align-middle">
                                <a href="/cabang/edit/<?= $c['id']; ?>" class="btn btn-success ">Edit</a>
                                <form action="/cabang/delete/<?= $c['id']; ?>" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('produk', 'pagination'); ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>