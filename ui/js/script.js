// Server URL
const PATH = "https://localhost/quote-api/";
// Paging: results per page
const PERPAGE = 10;

// CLEANING FUNCTIONS
function cleanBox() {
    document.getElementById("quote-text").innerHTML = "";
    document.getElementById("quote-work").innerHTML = "";
    document.getElementById("quote-chars").innerHTML = "";
    document.getElementById("quote-close").innerHTML = "";
    // Remove background from quote box
    document.getElementById("quote-box").classList.remove("card");
}

function cleanList() {
    document.getElementById("quote-list").innerHTML = "";
}

function cleanHeadline() {
    document.getElementById("headline").innerHTML = "";
}

function clearSearch() {
    document.getElementById("searchField").value = "";
    document.getElementById("searchFilter").value = "search";
}

// Function to fetch data from API and transform it to JS
async function getData(url) {
    const obj = await fetch(url);
    const text = await obj.text();
    const parsed = JSON.parse(text);
    return parsed;
}

// TEXT MODIFICATIONS

// Function to clip the quote to a certain size
function truncate(str, n) {
    return (str.length > n) ? str.slice(0, n-1) + '&hellip;' : str;
}

// Function to replace newlines to spaces
function lineToSpace(str) {
    const search = '\n';
    const replaceWith = ' ';
    return str.split(search).join(replaceWith);
}

// Function to change lines to paragraphs
function quoteToCard(str) {
    const search = '\n';
    const replaceWith = '</p><p class="card-text">';
    return '</p><p class="card-text">' + str.split(search).join(replaceWith) + '</p>';
}

// QUOTE BOX

// Function to add the card box to div
function cardBox() {
    document.getElementById("quote-box").classList.add("card");
}

// Function to list characters from array
function characters(array) {
    let str = "";
    for (const x in array) {
        let obj = array[x];
        str += "- " + searchButton("char", obj) + "<br>";
    }
    return "<p class='card-subtitle'>" + str + "</p>";
}

// Function to create a search link
function searchButton (filter, str) {
    return '<button class="link" value="' + str + '" onclick="setSearch(\'' + filter + '\', this.value)">' + str + '</button>';
}

// Get a random quote
function randomQuote() {
    singleQuote(PATH + "random");
}

// Get a quote by id
function quoteById(id) {
    let url = PATH + "quote/" + id;
    singleQuote(url);
}

// Function to get a single quote
async function singleQuote(url) {
    cleanBox();
    let item = await getData(url);
    cardBox();
    let quote = quoteToCard(item.quote);
    let work = "<p class='card-subtitle'>" + searchButton("work", item.work) + " by " + searchButton("author", item.author); + "</p>";
    let series = "";
    let chars = characters(item.characters);

    // If series isn't NULL
    if (item.series) {
        series = "<p class='card-subtitle'>" + searchButton("series", "(" + item.series + ")") + "</p>";
    }

    console.log(work);
    document.getElementById("quote-text").innerHTML = quote;
    document.getElementById("quote-work").innerHTML = work + series;
    document.getElementById("quote-chars").innerHTML = chars;
    document.getElementById("quote-close").innerHTML = " <button class=\"right close\" onclick=\"cleanBox()\"></button> <a href='edit.php?id=" + item.id + "'><button class=\"right edit\"></button></a>";
}


// LISTINGS

// Search from link
function setSearch(filter, search) {
    console.log(search);
    console.log(filter);
    document.getElementById("searchFilter").value = filter;
    document.getElementById("searchField").value = search;
    searchFunction(filter, search);
}

// Basic Search
function searchFunction(filter, search) {
    cleanList();

    if (search == "" && filter !== "search" && filter !=="quote") {
        console.log("no search + filter");
        setPageFilter(1, filter);
    } else {
        setPage(1, filter, search.toLowerCase());
    }
}

// Set Page for Quote results
function setPage(int, filter, search) {
    let offset = int * PERPAGE - PERPAGE;
    let param = "offset=" + offset + "&limit=" + PERPAGE;
    listQuotes(int, param, search, filter);
}

// Set Page for List by filter
function setPageFilter(int, filter) {
    let offset = int * PERPAGE - PERPAGE;
    let param = "offset=" + offset + "&limit=" + PERPAGE;
    listFilter(int, param, filter);
}

// Create row for result
function createRowQuote(obj) {
    // Clear null if no series exist
    if (obj.series) {
        series = obj.series;
    } else {
        series = "";
    }
    let chars = "";
    if (obj.characters) {
        if (obj.characters[0]) {
            chars += obj.characters[0];
        }
        if (obj.characters[1]) {
            chars += ", " + obj.characters[1]; 
        }
    }
    return "<tr class=\"align-baseline link\" onclick=\"quoteById(" + obj.id + ")\"><td>" + obj.id + "</td><td>" + lineToSpace(truncate(obj.quote, 120)) + "</td><td>" + obj.author + "</td><td>" + obj.work + "</td><td>" + series + "</td><td>" + chars + "</td></tr>";
}

async function listFilter(int, param, filter) {
    cleanList();
    let url = PATH + filter + "?" + param;
    let item = await getData(url);
    console.log(item);
    let array = item.results;
    let list = "";

    for (const x in array) {
        let obj = array[x];
        if (obj != null) {
            list += "<tr class=\"align-baseline\"><td class=\"link\" onclick=\"setSearch('" + filter + "' ,'" + obj + "')\">" + obj + "</td></tr>";
        }
    }

    // TITLE
    let title;
    if (filter == "series") {
        title = "Series";
    } else if (filter == "char") {
        title = "Characters";
    } else {
        title = filter.charAt(0).toUpperCase() + filter.slice(1) + "s";
    }
    let titlerow = "<h3>List of " + title.charAt(0).toUpperCase() + title.slice(1) + "</h3>"

    // BUTTONS
    let buttons;
    let pages = Math.ceil(item.total / PERPAGE);
    let previous = int - 1;
    let next = int + 1;

    if (int == 1) {
        buttons = "<p class=\"center\"><button onclick=\"setPageFilter(2,'" + filter + "')\" type=\"button\">Next</button></p>"
    } else if (int == pages) {
        buttons = "<p class=\"center\"><button onclick=\"setPageFilter(" + previous + ",'" + filter + "')\" type=\"button\">Previous</button></p>"
    } else {
        buttons = "<p class=\"center\"><button onclick=\"setPageFilter(" + previous + ",'" + filter + "')\" type=\"button\">Previous</button> <button onclick=\"setPageFilter(" + next + ", '" + filter + "')\" type=\"button\">Next</button></p>"
    }

    let table = "<table><tr class=\"noborder\"><td colspan=\"3\">Results: " + item.total + "</td></tr>";
    content = titlerow + table + list + "</table>" + buttons;
    document.getElementById("quote-list").innerHTML = content;
}

async function listQuotes(int, param, search, filter) {
    cleanList();
    let url = PATH + "quote?" + param;
    if (search !== "") {
        url += "&" + filter + "=" + search;
    }

    console.log(url);
    let item = await getData(url);
    let array = item.results;
    let list = "";

    for (const x in array) {
        let obj = array[x];
        list += createRowQuote(obj);
    }

    // BUTTONS

    let buttons;
    let pages = Math.ceil(item.total / PERPAGE);
    let previous = int - 1;
    let next = int + 1;

    if (int == 1) {
        buttons = "<p class=\"center\"><button onclick=\"setPage(2,'" + filter + "', '" + search + "')\" type=\"button\">Next</button></p>"
    } else if (int == pages) {
        buttons = "<p class=\"center\"><button onclick=\"setPage(" + previous + ",'" + filter + "', '" + search + "')\" type=\"button\">Previous</button></p>"
    } else {
        buttons = "<p class=\"center\"><button onclick=\"setPage(" + previous + ",'" + filter + "', '" + search + "')\" type=\"button\">Previous</button> <button onclick=\"setPage(" + next + ", '" + filter + "', '" + search + "')\" type=\"button\">Next</button></p>"
    }

    if (search == "" && filter == "search" || search == "" && filter == "quote") {
        title = "<h3>All Quotes</h3>";
    } else {
        if (filter == "work") {
            title = "<h3>Quotes with '" + search + "' in title</h3>";
        } else {
            title = "<h3>Quotes with '" + search + "' in " + filter + "</h3>";
        }
    }

    let content;
    let table;
    if (list == "") {
        content = title + "<table><tr class=\"noborder\"><td>No results.</td></tr></table>";
    } else {
        table = "<table><tr class=\"noborder\"><td colspan=\"3\">Results: " + item.total + "</td></tr><tr><th>ID</th><th>Quote</th><th>Author</th><th>Work</th><th>Series</th><th>Characters</th></tr>";
        content = title + table + list + "</table>" + buttons;
    }
    document.getElementById("quote-list").innerHTML = content;
}

// ADMIN

// Add, Edit, Delete
function logQuote(str) {

    let url = window.location.href;
    let urlArr = url.split("?id=");
    let id = urlArr[1];

    let data = {
        'author' : document.getElementById("author").value,
        'work' : document.getElementById("work").value,
        'series' : document.getElementById("series").value,
        'char1' : document.getElementById("char1").value,
        'char2' : document.getElementById("char2").value,
        'quote' : document.getElementById("quote").value,
        'id' : id
    }

    postJSON(str, data);
}

// Delete Confirmation
function deleteQuote() {
    let alert = "Are you sure you want to delete this quote from the database?";
    if (confirm(alert) == true) {

        let url = window.location.href;
        let urlArr = url.split("?id=");
        let id = urlArr[1];
        let data = {'id' : id} 

        postJSON("delete", data);
    }
}

// Post data to API
async function postJSON(str, data) {
    let url;
    if (str == "add") {
        url = PATH + "insert.php";
    } else if (str == "edit") {
        url = PATH + "update.php";
    } else if (str == "delete") {
        url = PATH + "delete.php";
    }
    console.log(url);
    console.log(data);

    try {
      const response = await fetch(url, {
        method: "POST",
        // mode: "same-origin",
        // credentials: "same-origin",
        headers: {
            "Content-Type": "application/json; charset=UTF-8",
            "Accept": "application/json"
        },
        body: JSON.stringify(data),
      });

      console.log('test');
      const result = await response.json();
      console.log("Success:", result);
      if (result == 'Success') {
        console.log('desmi');
        if (str == "delete") {
            location.href = 'delete-success.php';
        } else {
            location.href = 'success.php';
        }
      }
    } catch (error) {
      console.error("Error:", error);
    }
}

// Filling the form for edit quote
async function editForm(id) {
    let url = PATH + "quote/" + id;
    let item = await getData(url);

    document.getElementById("author").value = item.author;
    document.getElementById("work").value = item.work;
    document.getElementById("quote").value = item.quote;
    if (item.series != null) {
        document.getElementById("series").value = item.series;
    }
    if (item.characters[0] != null) {
        document.getElementById("char1").value = item.characters[0];
    }
    if (item.characters[1] != null) {
        document.getElementById("char2").value = item.characters[1]; 
    }
}

// Validate Form
function validateForm(str) {
    let author = document.forms["adminQuote"]["author"].value.trim();
    let work = document.forms["adminQuote"]["work"].value.trim();
    let quote = document.forms["adminQuote"]["quote"].value.trim();

    if (author == "") {
        alert("Fill in the author.");
        return false;
    } else if (work == "") {
        alert("Fill in the title of the book.");
        return false;
    } else if (quote == "") {
        alert("Fill in the quote.");
        return false;
    } else {
        logQuote(str);
    }
}
  