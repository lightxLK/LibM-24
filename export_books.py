import json
import xml.etree.ElementTree as ET
import os
from collections import Counter

# Ensure the books.json file exists and is populated
if os.path.exists('books.json'):
    with open('books.json', 'r') as file:
        books = json.load(file)

    # Create XML root element
    root = ET.Element('Library')

    # Add book entries to XML
    for book in books:
        book_element = ET.SubElement(root, 'Book')
        for key, value in book.items():
            child = ET.SubElement(book_element, key)
            child.text = str(value)

    # Calculate genre counts
    genres = [book['genre'] for book in books]
    genre_counts = Counter(genres)

    # Add GenreCounts section to XML
    genre_counts_element = ET.SubElement(root, 'GenreCounts')
    for genre, count in genre_counts.items():
        genre_element = ET.SubElement(genre_counts_element, 'Genre')
        name_element = ET.SubElement(genre_element, 'Name')
        name_element.text = genre
        count_element = ET.SubElement(genre_element, 'Count')
        count_element.text = str(count)

    # Write the XML data to a file
    tree = ET.ElementTree(root)
    tree.write('books.xml', encoding='utf-8', xml_declaration=True)
    print("Books and genre counts exported to books.xml")

else:
    print("Error: books.json not found.")
