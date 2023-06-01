<body>

    <!-- Navigation bar -->
    <nav class="navbar">
        <div class="container-fluid d-flex justify-content-around">

            <div><h3>Quotes from Gay Romance Novels</h3></div>
            <div>
                <?php if($title == "Add a Quote" || $title == "Edit a Quote" || $title == "Success") { ?>
                    <a href="index.php"><button><img src="svg/caret-left-fill.svg"> Back</button></a>
                <?php } else { ?>
                    <select type="button" name="searchFilter" id="searchFilter">
                        <option value="all">All</option>
                        <option value="quote">Quote</option>
                        <option value="author">Author</option>
                        <option value="work">Title</option>
                        <option value="series">Series</option>
                    </select>
                    <input onkeydown="if (event.key == 'Enter'){search()}else{}" id="searchField" type="text">
                    <button type="button" class="close" onclick="clearSearch()">x</button>
                    <button onclick="search()" type="button">Search</button> 
                    &nbsp;&nbsp;&nbsp;
                    <button onclick="randomQuote()" type="button">Random</button> 
                    <button onclick="setPage(1)" type="button">List All</button> 
                    <!-- <input onkeydown="if (event.key == 'Enter'){search()}else{}" id="searchfield" type="text">
                    <button onclick="search()" type="button">Search</button> 
                    &nbsp;&nbsp;&nbsp;<button onclick="clearSearch()" type="button">Clear</button> -->
                <?php } ?>
            </div>
            <div><a href="add.php">Add Quote</a></div>
        </div>
    </nav>