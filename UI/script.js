// Function to empty all fields and backgrounds
function clean() {
    document.getElementById("headline").innerHTML = "";
    document.getElementById("quote-box").innerHTML = "";
    document.getElementById("quote-list").innerHTML = "";
    // Remove background from quote box
    document.getElementById("quote-box").classList.remove("card");
}

// Function to add the card box to div
function cardBox() {
    document.getElementById("quote-box").classList.add("card");
}

// Function to fetch data from API and transform it to JS
async function getData(url) {
    const obj = await fetch(url);
    const text = await obj.text();
    const parsed = JSON.parse(text);
    return parsed;
}

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

// Function to list characters from array
function characters(array) {
    let str = "";
    for (const x in array) {
        let obj = array[x];
        str += "-" + obj + "<br>";
    }
    return '<p class="card-subtitle">' + str + '</p>';
}

// Function to get a random quote
async function randomQuote() {
    let item = await getData("https://geronimo.okol.org/~pohkat/quote-api/random.php");
    cardBox();

    let quote = quoteToCard(item.quote);
    let work = '<p class="card-subtitle">' + item.work + ' by ' + item.author + '</p>';
    let series = "";
    let chars = characters(item.characters);

    // If series isn't NULL
    if (item.series) {
        series = '<p class="card-subtitle">' + item.series + '</p>';
    }

    document.getElementById("quote-text").innerHTML = quote;
    document.getElementById("work").innerHTML = work + series;
    document.getElementById("chars").innerHTML = chars;
}

// For the listing
// let quote = lineToSpace(truncate(item.quote, 75));