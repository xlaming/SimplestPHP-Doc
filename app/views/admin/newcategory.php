<div class="card has-margin-right-50">
    <div class="card-content">
        <div class="content">
            <h2>New Category</h2>
            
            <?php if ($message['text']): ?>
            <article class="message is-<?php echo $message['status']; ?>">
                <div class="message-body">
                    <?php echo $message['text']; ?>          
                </div>
            </article>
            <?php endif ; ?>
            
            <form method="POST">
                <div class="field">
                    <label class="label">Category name</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" name="name" type="text" placeholder="Category name here">
                        <span class="icon is-small is-left">
                            <i class="fas fa-list-alt"></i>
                        </span>
                    </div>
                </div>
                
                <div class="field">
                    <label class="label">Category icon</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" name="icon" type="text" placeholder="Font awesome regular icon">
                        <span class="icon is-small is-left">
                            <i class="fas fa-link"></i>
                        </span>
                    </div>
                </div>

                <?php \App::inputCSRF(); ?>
                <div class="field">
                    <div class="control">
                        <button class="button is-link is-primary">Add</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
