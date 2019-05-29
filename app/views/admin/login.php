<div class="card has-margin-right-50">
    <div class="card-content">
        <div class="content">
            <h2>AdminCP</h2>
            
            <?php if ($message['text']): ?>
            <article class="message is-<?php echo $message['status']; ?>">
                <div class="message-body">
                    <?php echo $message['text']; ?>          
                </div>
            </article>
            <?php endif ; ?>
            
            <form method="POST">
                <div class="field">
                    <label class="label">Username</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" name="user" type="text" placeholder="Your username...">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" name="pass" type="password" placeholder="Your password...">
                        <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                    </div>
                </div>

                <?php \App::inputCSRF(); ?>
                <div class="field">
                    <div class="control">
                        <button class="button is-link is-primary">Log in</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
