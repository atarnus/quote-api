<?php
    $title = 'Add quote to DB';
    require_once('header.php');
?>

    <body>

        <!-- Navigation bar -->
        <!-- <nav class="navbar">
            <div class="container-fluid d-flex justify-content-around">
                        <div></div>
                        <div>
                            <button onclick="setPage(1)" type="button">List All</button> 
                            <button onclick="randomQuote()" type="button">Random</button>
                            <input onkeydown="if (event.key == 'Enter'){search()}else{}" id="searchfield" type="text">
                            <button onclick="search()" type="button">Search</button> 
                            &nbsp;&nbsp;&nbsp;<button onclick="clearSearch()" type="button">Clear</button>
                        </div>
                        <div></div>
                    </div>
                </div>
            </div>
        </nav> -->

        <div class="container fluid max-width-600 justify-content-center">
            <div>
            <h2>Add quote to database</h2>
</div>
            <form id="addQuote" name="addQuote" method="post" action="insert-exe.php">
                <div class="row">
                    <div class="col-20">
                        <label class="form-label" for="author">Author:</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="author" id="author" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-20">
                        <label class="form-label" for="size">Work:</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="work" id="work" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-20">
                        <label class="form-label" for="series">Series:</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="series" id="series">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-20">
                        <label id="chars">Characters:</label>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="char1" id="char1" artia-labelledby="chars">
                        <input type="text" class="form-control" name="char2" id="char2" artia-labelledby="chars">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-20">
                        <label class="form-label" for="quote">Quote:</label>
                    </div>
                    <div class="col">
                        <textarea name="quote" class="form-control" id="quote" rows="6" required></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-20">&nbsp;</div>
                    <div class="col">
                        <input type="submit" class="form-control" name="submit" value="Submit">
                    </div>
                </div>

            </form>
        </div>
    </body>
</html>