<div class="card has-margin-right-50">
    <div class="card-content">
        <div class="content">
            <h2>Categories</h2>
            
            <table>
                <thead>
                    <th>Icon</th>
                    <th>Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach ($page->getCategories() as $cat): ?>
                    <tr>
                        <td><i class="fa fa-<?php echo $cat['icon']; ?>"> </i></td>
                        <td><?php echo $cat['name']; ?></td>
                        <td><a href="/admin/del_category?id=<?php echo $cat['id']; ?>"><i class="fa fa-minus-circle"> </i></a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
