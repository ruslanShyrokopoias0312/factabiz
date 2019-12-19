<div class="card">

    <div class="card-header">
        <h3 class="card-title"><?php echo $LANG['label-create-post']; ?></h3>
    </div>

    <div class="remotivation_block mb-4" style="display:none">
        <h1><?php echo $LANG['msg-post-sent']; ?></h1>

        <button onclick="Profile.showPostForm(); return false;" class="button blue primary_btn"><?php echo $LANG['action-another-post']; ?></button>

    </div>

    <?php

        $s_username = auth::getCurrentUserLogin();

        if (isset($profileInfo)) {

            $s_username = $profileInfo['username'];
        }
    ?>

    <form onsubmit="Profile.post('<?php echo $s_username; ?>'); return false;" class="profile_question_form" action="/<?php echo $s_username; ?>/post" method="post">
        <input autocomplete="off" type="hidden" name="authenticity_token" value="<?php echo auth::getAuthenticityToken(); ?>">
        <textarea name="postText" maxlength="1000" placeholder="<?php echo $LANG['label-placeholder-post']; ?>"></textarea>
        <div class="form_actions">

            <div class="item-image-progress hidden">
                <div class="progress-bar " role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            <div class="item-actions">

                <button style="padding: 7px 16px;" class="primary_btn blue" value="ask"><?php echo $LANG['action-post']; ?></button>

                <div class="btn btn-secondary item-image-action-button item-add-image">
                    <input type="file" id="item-image-upload" name="uploaded_file">
                    <i class="iconfont icofont-ui-image mr-1"></i>
                    <?php echo $LANG['action-add-img']; ?>
                </div>

                <span id="word_counter" style="display: none">1000</span>

                <?php

                    if (isset($page_id) && $page_id != 'group') {

                        ?>
                        <div class="main_actions">
                            <label for="mode_checkbox" class="noselect"><?php echo $LANG['label-for-friends']; ?></label>
                            <input id="mode_checkbox" name="mode_checkbox" type="checkbox" style="margin-top: 5px;">
                        </div>
                        <?php
                    }
                ?>

            </div>

            <div class="img_container">

                <div class="img-items-list-page" style="margin-left: -10px; margin-right: -10px">

                </div>

            </div>

        </div>
    </form>

</div>