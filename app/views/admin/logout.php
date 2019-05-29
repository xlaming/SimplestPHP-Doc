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

        </div>
    </div>
</div>
