<?php require_once 'vscode/app/views/shares/header.php'; ?>

<h1 class="mb-4">Sửa sản phẩm</h1>

<form method="post" action="index.php?controller=product&action=edit&id=<?= $this->product->id ?>">
    <div class="mb-3">
        <label for="name" class="form-label">Tên sản phẩm:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($this->product->name) ?>" required>
    </div>
    
    <div class="mb-3">
        <label for="description" class="form-label">Mô tả:</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($this->product->description) ?></textarea>
    </div>
    
    <div class="mb-3">
        <label for="price" class="form-label">Giá:</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= htmlspecialchars($this->product->price) ?>" required>
    </div>
    
    <div class="mb-3">
        <label for="category_id" class="form-label">Danh mục:</label>
        <select class="form-control" id="category_id" name="category_id">
            <?php while($category = $categories->fetch(PDO::FETCH_ASSOC)): ?>
                <option value="<?= $category['id'] ?>" <?= $this->product->category_id == $category['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['name']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>
    
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        <a href="index.php?controller=product&action=list" class="btn btn-secondary">Quay lại danh sách sản phẩm</a>
    </div>
</form>

<?php require_once 'vscode/app/views/shares/footer.php'; ?>