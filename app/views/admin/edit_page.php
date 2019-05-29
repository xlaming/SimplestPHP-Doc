<div class="card has-margin-right-50">
    <div class="card-content">
        <div class="content">
            <h2>Editing: <?php echo $p['name']; ?></h2>
            
            <?php if ($message['text']): ?>
            <article class="message is-<?php echo $message['status']; ?>">
                <div class="message-body">
                    <?php echo $message['text']; ?>          
                </div>
            </article>
            <?php endif ; ?>
            
            <form method="POST">
                <div class="field">
                    <label class="label">Page name</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" name="name" type="text" placeholder="Page name..." value="<?php echo $p['name']; ?>">
                        <span class="icon is-small is-left">
                            <i class="fas fa-list-alt"></i>
                        </span>
                    </div>
                </div>
                
                <div class="field">
                    <label class="label">/Slug URL</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" name="slug" type="text" placeholder="Slug URL..." value="<?php echo $p['slug']; ?>">
                        <span class="icon is-small is-left">
                            <i class="fas fa-link"></i>
                        </span>
                    </div>
                </div>
                
                <div class="field">
                    <label class="label">Category</label>
                    <div class="control has-icons-left has-icons-right">
                        <div class="select">
                            <select name="cat_id">
                                <?php foreach($page->getCategories() as $cat) {
                                    $selected = $cat['id'] === $p['category_id'] ? 'selected' : '';
                                    print "<option {$selected} value=\"{$cat['id']}\">{$cat['name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <span class="icon is-small is-left">
                            <i class="fas fa-link"></i>
                        </span>
                    </div>
                </div>
                
                <div class="field">
                    <label class="label">Text</label>
                    <div class="control has-icons-left has-icons-right">
                        <textarea class="textarea has-fixed-size" name="text" placeholder="Text goes here..." rows="<?php echo substr_count($p['content'], PHP_EOL); ?>"><?php echo Vendor\View::TextArea($p['content']); ?></textarea>
                    </div>
                </div>

                <?php \App::inputCSRF(); ?>
                <div class="field">
                    <div class="control">
                        <button class="button is-link is-primary">Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
