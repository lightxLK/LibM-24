document.getElementById("searchBookForm").addEventListener("submit", async function (e) {
    e.preventDefault();
    const title = document.getElementById("search_title").value.trim();
    const author = document.getElementById("search_author").value.trim();
    const year = document.getElementById("search_year").value.trim();

    // Fetch search results using PHP backend
    const response = await fetch("search_books.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ title, author, year }),
    });
    const books = await response.json();

    const tableBody = document.getElementById("results").querySelector("tbody");
    tableBody.innerHTML = ""; // Clear previous results

    books.forEach(book => {
        const row = `<tr>
            <td>${book.id}</td>
            <td>${book.title}</td>
            <td>${book.author}</td>
            <td>${book.publication_year}</td>
            <td>${book.genre}</td>
        </tr>`;
        tableBody.innerHTML += row;
    });
});

// Export to XML handler
document.getElementById("exportXML").addEventListener("click", async function () {
    await fetch("export_books.php");
    alert("Books exported to XML!");
});
