document.getElementById("addBookForm").addEventListener("submit", function (e) {
    const title = document.getElementById("title").value.trim();
    const author = document.getElementById("author").value.trim();
    const publicationYear = parseInt(document.getElementById("publication_year").value);
    const genre = document.getElementById("genre").value.trim();

    if (!title || !author || !genre || isNaN(publicationYear) || publicationYear <= 2000) {
        e.preventDefault();
        alert("All fields are required, and the publication year must be greater than 2000.");
    } else {
        alert("Book successfully added!");
    }
});
