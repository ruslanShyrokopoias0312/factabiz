<?php

if (isset($_GET['action'])) {

    ignore_user_abort(true);
    set_time_limit(0); // disable the time limit for this script
    
    $action = isset($_GET['action']) ? $_GET['action'] : '';
    $action = helper::clearText($action);
    $action = helper::escapeText($action);
    
    if ( count(glob(TERMS_PATH.$action.'*')) > 0 ) {
        foreach( glob(TERMS_PATH.$action.'*') as $file){ // iterate files
            if(is_file($file)) {
                $filename = basename($file);
            }
        }
    }

    if (!isset($filename)) {
        header("Location: /terms");
    } else {
        // define the path to your download folder plus assign the file name
        $path = TERMS_PATH.$action.$filename;
        // check that file exists and is readable
        if (file_exists($path) && is_readable($path)) {
            // get the file size and send the http headers
            $size = filesize($path);
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.$filename);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: '.$size);
            
            ob_clean();
            flush();
            readfile($path); 
        } else {
            //echo $err;
        }
    }

}

?> 

<section class="standard-page">
    <h6>1. Agreement Types- Contract Papers, e.g.:  Non- Registered Deed.</h6>
    <a class="btn btn-secondary btn-block text-white" href="?action=1/">
        Download the Deed Paper Sample & Relevant Terms               
    </a>
</section>

<section class="standard-page">
    <h6>2. Biz Connect/Entrepreneur Connect - Terms of use Policy.</h6>
    <a class="btn btn-secondary btn-block text-white" href="?action=2/">
        Download the Biz Connect Terms -Terms of Use Policy               
    </a>
</section>

<section class="standard-page">
    <h6>3. Contract Papers - Agents, Marchant, iC- Cafe Owners, Contractors.</h6>
    <a class="btn btn-secondary btn-block text-white" href="?action=3/">
        Download the contract Papers for iC-Cafe & Others         
    </a>
</section>

<section class="standard-page">
    <h6>4. Medical Services Terms.</h6>
    <a class="btn btn-secondary btn-block text-white" href="?action=4/">
        Download the Medical Terms Documents               
    </a>
</section>

<section class="standard-page">
    <h6>5. Other Terms / Documents</h6>
    <a class="btn btn-secondary btn-block text-white" href="?action=5/">
        Download the Medical Terms Documents               
    </a>
</section>
