<?php

	/*!
	 * ifsoft.co.uk
	 *
	 * http://ifsoft.com.ua, http://ifsoft.co.uk
	 * raccoonsquare@gmail.com
	 *
	 * Copyright 2012-2019 Demyanchuk Dmitry (raccoonsquare@gmail.com)
	 */

	$profileId = $helper->getUserId($request[0]);

	$imageExists = true;

	$profile = new profile($dbo, $profileId);

	$profile->setRequestFrom(auth::getCurrentUserId());
	$profileInfo = $profile->get();

	if ($profileInfo['error'] === true) {

		include_once("../html/error.inc.php");
		exit;
	}

	if ($profileInfo['state'] != ACCOUNT_STATE_ENABLED) {

		include_once("../html/stubs/profile.inc.php");
		exit;
	}

    $gallery = new gallery($dbo);
    $gallery->setRequestFrom(auth::getCurrentUserId());

	$itemId = helper::clearInt($request[2]);

	$imageInfo = $gallery->info($itemId);

	if ($imageInfo['error'] === true) {

        // Missing
		$imageExists = false;
	}

	if ($imageExists && $imageInfo['removeAt'] != 0) {

		// Missing
		$imageExists = false;
	}

	if ($imageExists && $profileInfo['id'] != $imageInfo['fromUserId']) {

        // Missing
		$imageExists = false;
    }

	$page_id = "image";

	$css_files = array("main.css", "my.css", "tipsy.css");

	$page_title = $profileInfo['fullname']." | ".APP_HOST."/".$profileInfo['username'];

	include_once("../html/common/header.inc.php");

?>

<body class="">


	<?php
		include_once("../html/common/topbar.inc.php");
	?>


	<div class="wrap content-page">

		<div class="main-column">

            <div class="content-list-page">

                <?php

                if ($imageExists) {

                    ?>

                    <div class="items-list content-list m-0">

                        <?php

                        draw::image($imageInfo, $LANG, $helper, true);

                        ?>

                    </div>

                    <?php

                } else {

                    ?>

                    <div class="card information-banner">
                        <div class="card-header">
                            <div class="card-body">
                                <h5 class="m-0"><?php echo $LANG['label-image-missing']; ?></h5>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                ?>


            </div>
		</div>

		<?php

			include_once("../html/common/sidebar.inc.php");
		?>

	</div>

	<?php

		include_once("../html/common/footer.inc.php");
	?>

	<script type="text/javascript" src="/js/jquery.tipsy.js"></script>

	<script type="text/javascript">

		var replyToUserId = 0;

		<?php

            if (auth::getCurrentUserId() == $profileInfo['id']) {

                ?>
					var myPage = true;
				<?php
    		}
		?>

		$(document).ready(function() {

			$(".page_verified").tipsy({gravity: 'w'});
			$(".verified").tipsy({gravity: 'w'});
		});

	</script>


</body
</html>