<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <a href="/" class="btn btn-outline-primary my-3">Back</a>

    <div class="row">
        <div class="col">
            <h3 class="mt-3">Edit Produk</h3>
            <form action="/produk/update/<?= $produk['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" name="nama" id="nama" aria-describedby="emailHelp" autocomplete="off" value="<?= (old('nama')) ? old('nama') : $produk['nama'] ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok <small>(ex: 3 boks, 3 pcs, 3 renceng, dll)</small></label>
                    <input type="text" class="form-control <?= ($validation->hasError('stok')) ? 'is-invalid' : ''; ?>" id="stok" name="stok" autocomplete="off" value="<?= (old('stok')) ? old('stok') : $produk['stok'] ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('stok'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>