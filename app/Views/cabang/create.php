<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <a href="/" class="btn btn-outline-primary my-3">Back</a>

    <div class="row">
        <div class="col">
            <h3 class="mt-3">Tambah Cabang</h3>

            <form action="/cabang/save" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Cabang</label>
                    <input type="text" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" name="alamat" id="alamat" aria-describedby="emailHelp" autocomplete="off" value="<?= old('alamat'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('alamat'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Cabang</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>