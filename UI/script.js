// Function to empty all fields and backgrounds
function clean() {
    document.getElementById("headline").innerHTML = "";
    document.getElementById("quote-list").innerHTML = "";
    document.getElementById("quote-text").innerHTML = "";
    document.getElementById("quote-work").innerHTML = "";
    document.getElementById("quote-chars").innerHTML = "";
    // Remove background from quote box
    document.getElementById("quote-box").classList.remove("card");
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
    singleQuote("https://geronimo.okol.org/~pohkat/quote-api/random");
}

// Get a quote by id
function quoteById(id) {
    let url = "https://geronimo.okol.org/~pohkat/quote-api/quote/" + id;
    singleQuote(url);
}

// Function to get a single quote
async function singleQuote(url) {
    clean();
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
}

// LISTINGS

const TABLE = "<table><tr><th>ID</th><th>Quote</th><th>Author</th><th>Work</th><th>Series</th></tr>";

async function listAllQuotes() {
    clean();
    let item = await getData("https://geronimo.okol.org/~pohkat/quote-api/quote");
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

    document.getElementById("quote-list").innerHTML = TABLE + list + "</table>";
}