<div class="card has-margin-right-50">
    <div class="card-content">
        <div class="content">
        
            <?php if ($message['text']): ?>
            <article class="message is-<?php echo $message['status']; ?>">
                <div class="message-body">
                    <?php echo $message['text']; ?>          
                </div>
            </article>
            <?php endif ; ?>
            
            <div class="columns">
            
                <div class="column">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">
                                Total Users
                            </p>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <?php echo $user->getTotal('admins'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="column">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">
                                Total Pages
                            </p>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <?php echo $user->getTotal('pages'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="column">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">
                                Total Categories
                            </p>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <?php echo $user->getTotal('categories'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="column">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">
                                Framework Version
                            </p>
                        </header>
                        <div class="card-content">
                            <div class="content">
                                <?php echo $user->getConfig('version'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <form method="POST">
                <div class="field">
                    <label class="label">Download URL</label>
                    <div class="control">
                        <input class="input" name="down_link" type="text" value="<?php echo $user->getConfig('down_link'); ?>">
                    </div>
                </div>
                
                <br />
                
                <div class="field">
                    <label class="label">GitHub URL</label>
                    <div class="control">
                        <input class="input" name="git_link" type="text" value="<?php echo $user->getConfig('git_link'); ?>">
                    </div>
                </div>
                
                <div class="field">
                    <label class="label">Version</label>
                    <div class="control">
                        <input class="input" name="version" type="text" value="<?php echo $user->getConfig('version'); ?>">
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
        
        <br />
            
        <article class="message">
            <div class="message-body">
                Highlight: <?php echo $hl[0]; ?>        
            </div>
        </article>
                
        <a class="button is-link" href="?hl=<?php echo $hl[2]; ?>"><?php echo $hl[1]; ?> Highlight</a>
                
    </div>
</div>