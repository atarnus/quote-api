<body>

    <!-- Navigation bar -->
    <nav class="navbar">
        <div class="container-fluid d-flex justify-content-around">

                    <div>
                        <?php if($title == "Add a Quote" || $title == "Edit a Quote" || $title == "Success") { ?>
                            <a href="index.php"><button><img src="svg/caret-left-fill.svg"> Back</button></a>
                        <?php } else { ?>
                            <button onclick="setPage(1)" type="button">List All</button> 
                            <button onclick="randomQuote()" type="button">Random</button>
                            <!-- <input onkeydown="if (event.key == 'Enter'){search()}else{}" id="searchfield" type="text">
                            <button onclick="search()" type="button">Search</button> 
                            &nbsp;&nbsp;&nbsp;<button onclick="clearSearch()" type="button">Clear</button> -->
                        <?php } ?>
                    </div>
                    <div><a href="add.php">Add Quote</a></div>
                </div>
            </div>
        </div>
    </nav>