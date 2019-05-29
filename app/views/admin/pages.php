<div class="card has-margin-right-50">
    <div class="card-content">
        <div class="content">
            <h2>Categories</h2>
            
            <table>
                <thead>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach ($page->getAll() as $p): ?>
                    <tr>
                        <td><?php echo $p['name']; ?></td>
                        <td><?php echo $page->getCategory($p['category_id']); ?></td>
                        <td>
                            <a href="/admin/del_page?id=<?php echo $p['id']; ?>"><i class="fa fa-minus-circle"> </i></a> - 
                            <a href="/admin/edit_page?id=<?php echo $p['id']; ?>"><i class="far fa-edit"> </i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
