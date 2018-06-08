<div class="row">

    <div class="col-lg-13 col-lg-offset-7">

        <form>

            <div class="row">
                <input type="text" placeholder="<?php echo e($event_your_name); ?>">
            </div>

            <div class="row">
                <input type="email" placeholder="<?php echo e($event_your_email); ?>" spellcheck="false">
            </div>


            <div>
                <select  style="width: 100%; height: 50px;">
                    <option value="1" selected>111111111111111111111111</option>
                    <option value="2">22222222222222222222222222222</option>
                </select>
            </div>

            <div>
                <textarea style="margin-top: 10px;" rows="5" placeholder="<?php echo e($event_description); ?>" spellcheck="true"></textarea>
            </div>

            <div>
                <button class="newsletter-btn" type="submit" value="<?php echo e($event_send); ?>"><?php echo e($event_send); ?><i class="icon-chevron-circle-right"></i></button>
            </div>

        </form>

    </div>

</div>