<?php

    $title = 'Edit a Quote';
	// require_once('auth.php');
    require_once('header.php');
    include_once('nav.php');
?>

    <div class="container fluid max-width-600 justify-content-center">
        <div><h2>Edit a quote in database</h2></div>

        <form id="addQuote" name="addQuote">
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
                    <input type="text" class="form-control" name="char1" id="char1" aria-labelledby="chars">
                    <input type="text" class="form-control" name="char2" id="char2" aria-labelledby="chars">
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

        </form>

        <div class="row">
            <div class="col-20">&nbsp;</div>
            <div class="col">
                <button onclick="return editQuote()" class="form-control" name="submit">Submit</button>
            </div>
        </div>

    </div>
    <script>
        let url = window.location.href;
        let urlArr = url.split("?id=");
        let id = urlArr[1];
        editForm(id);
    </script>
</body>
</html>