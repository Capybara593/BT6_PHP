<?php require_once 'vscode/app/views/shares/header.php'; ?>

<h1 class="mb-4"><?= htmlspecialchars($this->product->name) ?></h1>

<div class="card mb-4">
    <div class="card-body">
        <h5 class="card-title">Chi tiết sản phẩm</h5>
        <p class="card-text"><strong>Mô tả:</strong> <?= htmlspecialchars($this->product->description) ?></p>
        <p class="card-text"><strong>Giá:</strong> <?= number_format($this->product->price, 2) ?></p>
        <p class="card-text"><strong>Danh mục:</strong> <?= htmlspecialchars($this->product->category_name) ?></p>
        
        <div class="mt-3">
            <a href="index.php?controller=product&action=edit&id=<?= $this->product->id ?>" class="btn btn-warning">Sửa</a>
            <a href="index.php?controller=product&action=list" class="btn btn-secondary">Quay lại danh sách</a>
        </div>
    </div>
</div>

<?php require_once 'vscode/app/views/shares/footer.php'; ?>