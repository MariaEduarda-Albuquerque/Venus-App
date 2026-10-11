

<?php $__env->startSection('title', 'Painel Administrativo'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/denuncia.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <h1 class="page-title">Resposta à denúncia</h1>

        <div class="tickets-wrapper">
            <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="card">
                    
                    <header class="card-header">
                        <div class="ticket-info">
                            <h2>
                                <span class="ticket-id">ID <?php echo e($ticket['id']); ?></span> - 
                                <span class="ticket-subject"><?php echo e($ticket['subject']); ?></span>
                            </h2>
                            <span class="ticket-date">
                                <?php echo e($ticket['date']); ?>

                            </span>
                        </div>
                        <div class="navigation-buttons">
                            <button type="button" class="nav-btn" aria-label="Anterior">&lt;</button>
                            <button type="button" class="nav-btn" aria-label="Próximo">&gt;</button>
                        </div>
                    </header>

                    <section class="user-message">
                        <div class="user-info">
                            <div class="avatar-icon">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                                </svg>
                            </div>
                            <div class="user-details">
                                <h3 class="user-name"><?php echo e($ticket['user']['name']); ?></h3>
                                <span class="user-email"><?php echo e($ticket['user']['email']); ?></span>
                            </div>
                        </div>

                        <div class="message-body">
                            <?php echo nl2br(e($ticket['description'])); ?>

                        </div>
                    </section>

                    <hr class="divider">

                    <section class="support-response">
                        <div class="support-info">
                            <div class="avatar-icon support-avatar">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                                </svg>
                            </div>
                            <h3 class="support-name"><?php echo e($ticket['support_team']); ?></h3>
                        </div>

                        <form action="#" method="POST" enctype="multipart/form-data" class="response-box">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="ticket_id" value="<?php echo e($ticket['id']); ?>">

                            <textarea 
                                name="response_text" 
                                class="response-textarea" 
                                placeholder="Digite sua resposta aqui..."
                            ><?php echo e(old('response_text', $ticket['response'])); ?></textarea>
                            
                            <div class="response-actions">
                                <label class="attach-button">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/>
                                    </svg>
                                    <span>Anexar</span>
                                    <input type="file" name="attachment" class="hidden-file-input">
                                </label>

                                <button type="submit" class="send-button">Responder</button>
                            </div>
                        </form>
                    </section>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\Venus-App\Painel-Administrador\resources\views/admin/suporte.blade.php ENDPATH**/ ?>