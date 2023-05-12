<?php
    $title = 'Add a Quote';
	// require_once('auth.php');
    require_once('header.php');
    include_once('nav.php');
?>

<!-- Main section -->
<div class="container-fluid max-width-1200">

    <!-- Page headline -->
    <div class="row">
        <div class="col d-flex justify-content-center">
            <p id="headline"></p>
        </div>
    </div>

    <!-- Quote box -->
    <div class="row">
        <div class="col d-flex justify-content-center">
            <div id="quote-box">
                <div class="card-body">
                    <div class="row">
                        <div id="quote-close" class="g-0"></div>
                    </div>
                    <div id="quote-text"></div>
                    <!-- <h5 class="card-title">Card title</h5> -->
                    <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                    <!-- <p class="card-text"></p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a> -->
                    <div class="row mt-4">
                        <div id="quote-chars" class="col"></div>
                        <div id="quote-work" class="col-sm-7 right"></div>
                    </div>
                </div>
                </div>
        </div>
    </div>

    <!-- Quote list -->
    <div class="row">
        <div id="quote-list" class="col justify-content-left mt-5">
            <!-- <p id="quote-list"></p> -->
        </div>
    </div>
   
</div>

</body>
</html>