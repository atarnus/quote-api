// Server URL
const PATH = "https://localhost/quote-api/";
// Paging: results per page
const PERPAGE = 3;

// Cleaning functions
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
    const search = '\r\n';
    const replaceWith = ' ';
    return str.split(search).join(replaceWith);
}

// Function to change lines to paragraphs
function quoteToCard(str) {
    const search = '\r\n';
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
        str += "-" + obj + "<br>";
    }
    return '<p class="card-subtitle">' + str + '</p>';
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
    let work = '<p class="card-subtitle">' + item.work + ' by ' + item.author + '</p>';
    let series = "";
    let chars = characters(item.characters);

    // If series isn't NULL
    if (item.series) {
        series = '<p class="card-subtitle">' + item.series + '</p>';
    }

    console.log(quote);
    document.getElementById("quote-text").innerHTML = quote;
    document.getElementById("quote-work").innerHTML = work + series;
    document.getElementById("quote-chars").innerHTML = chars;
    document.getElementById("quote-close").innerHTML = "<button class=\"right close\"  onclick=\"cleanBox()\">x</button>";
}

// LISTINGS

const TABLE = "<table><tr><th>ID</th><th>Quote</th><th>Author</th><th>Work</th><th>Series</th></tr>";

function setPage(int) { 
    let offset = int * PERPAGE - PERPAGE;
    let str = "quote?offset=" + offset + "&limit=" + PERPAGE;
    listAllQuotes(int, str);
}

async function listAllQuotes(int, str) {
    cleanList();
    let url = PATH + str;
    let item = await getData(url);
    console.log(item);
    let array = item.results;
    let list = "";
    let series;

    for (const x in array) {
        let obj = array[x];

        // Clear null if no series exist
        if (obj.series) {
            series = obj.series;
        } else {
            series = "";
        }

        list += "<tr class=\"link\" onclick=\"quoteById(" + obj.id + ")\"><td>" + obj.id + "</td><td>" + lineToSpace(truncate(obj.quote, 75)) + "</td><td>" + obj.author + "</td><td>" + obj.work + "</td><td>" + series + "</td></tr>";
    }

    // BUTTONS

    let buttons;
    let pages = Math.ceil(item.total / PERPAGE);
    let previous = int - 1;
    let next = int + 1;

    if (int == 1) {
        buttons = "<p class=\"center\"><button onclick=\"setPage(2)\" type=\"button\">Next</button></p>"
    } else if (int == pages) {
        buttons = "<p class=\"center\"><button onclick=\"setPage(" + previous + ")\" type=\"button\">Previous</button></p>"
    } else {
        buttons = "<p class=\"center\"><button onclick=\"setPage(" + previous + ")\" type=\"button\">Previous</button> <button onclick=\"setPage(" + next + ")\" type=\"button\">Next</button></p>"
    }

    document.getElementById("quote-list").innerHTML = TABLE + list + "</table>" + buttons;
}