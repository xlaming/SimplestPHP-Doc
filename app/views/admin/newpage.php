<div class="card has-margin-right-50">
    <div class="card-content">
        <div class="content">
            <h2>New page</h2>
            
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
                        <input class="input" name="name" type="text" placeholder="Page name...">
                        <span class="icon is-small is-left">
                            <i class="fas fa-list-alt"></i>
                        </span>
                    </div>
                </div>
                
                <div class="field">
                    <label class="label">/Slug URL</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" name="slug" type="text" placeholder="Slug URL...">
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
                                    print "<option value=\"{$cat['id']}\">{$cat['name']}</option>";
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
                        <textarea class="textarea" name="text" placeholder="Text goes here..." rows="30"></textarea>
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
