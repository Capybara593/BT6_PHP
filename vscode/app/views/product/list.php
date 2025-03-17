<?php require_once 'vscode/app/views/shares/header.php'; ?>

<h1 class="mb-4">Danh sách sản phẩm</h1>

<div class="mb-3">
    <a href="index.php?controller=product&action=add" class="btn btn-success">Thêm sản phẩm mới</a>
    <a href="index.php?controller=category&action=list" class="btn btn-info">Quản lý danh mục</a>
</div>

<?php if($stmt->rowCount() > 0): ?>
    <div class="list-group">
        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
            <div class="list-group-item">
                <div class="row">
                    <?php if(!empty($row['image'])): ?>
                    <div class="col-md-2">
                        <img src="public/uploads/<?= $row['image'] ?>" alt="<?= htmlspecialchars($row['name']) ?>" class="img-thumbnail" style="max-width: 100%; max-height: 100px;">
                    </div>
                    <div class="col-md-10">
                    <?php else: ?>
                    <div class="col-md-12">
                    <?php endif; ?>
                        <div class="d-flex w-100 justify-content-between mb-2">
                            <h5 class="mb-1 text-primary"><?= htmlspecialchars($row['name']) ?></h5>
                            <small>Giá: <?= number_format($row['price'], 2) ?></small>
                        </div>
                        <p class="mb-1"><?= htmlspecialchars($row['description']) ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">Danh mục: <?= htmlspecialchars($row['category_name']) ?></small>
                            <div>
                                <a href="index.php?controller=product&action=edit&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                <a href="index.php?controller=product&action=delete&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="alert alert-info">Không có sản phẩm nào.</div>
<?php endif; ?>

<?php require_once 'vscode/app/views/shares/footer.php'; ?>