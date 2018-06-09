<div class="footer-lockup">

    <form id="form-event" class="col-md-18 col-md-offset-1">

        <div class="form-group">
            <input id="name" name="name" class="form-control" type="text" placeholder="<?php echo e($event_your_name); ?>" />
        </div>

        <div class="form-group">
            <input id="email" name="email" class="form-control" type="email" placeholder="<?php echo e($event_your_email); ?>" spellcheck="false" />
        </div>

        <div class="form-group">
            <input id="event" name="event" class="form-control" type="text" placeholder="<?php echo e($event_name); ?>" />
        </div>        

        <div>
            <select id="type" name="type" class="form-control">
                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if( $lang == 'es' ): ?>
                        <option value="<?php echo e($type->get_id()); ?>"><?php echo e($type->get_nameES()); ?></option>
                    <?php else: ?>
                         <option value="<?php echo e($type->get_id()); ?>"><?php echo e($type->get_nameEU()); ?></option>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <textarea id="description" name="description" class="form-control"  style="margin-top: 10px;" rows="5" placeholder="<?php echo e($event_description); ?>" spellcheck="true"></textarea>
        </div>
        
        <div class="form-group">
            <input id="lat" name="lat" type="hidden" value="0" />
            <input id="lng" name="lng" type="hidden" value="0" />
            <div id="map" data-start-lat="<?php echo e($app_start_position_lat); ?>" data-start-lng="<?php echo e($app_start_position_lng); ?>"></div>
        </div>

        <div>
            <button class="newsletter-btn" type="submit" value="<?php echo e($event_send); ?>"><?php echo e($event_send); ?><i class="icon-chevron-circle-right"></i></button>
        </div>

    </form>

    <form id="success-message" action="index.php#">

        <div class="col-md-18 col-md-offset-1 text-center">
            <div><?php echo e($event_message_success_first); ?></div>
            <div><?php echo e($event_message_success_second); ?></div>
            <div><?php echo e($event_message_success_third); ?></div>           
        </div>    

        <div class="col-md-18 col-md-offset-1 text-center">
            <button class="newsletter-btn" type="submit" value="<?php echo e($button_continue); ?>"><?php echo e($button_continue); ?><i class="icon-chevron-circle-right"></i></button>
        </div>

    </form>        

</div>