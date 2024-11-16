import json
import xml.etree.ElementTree as ET
import os

# Ensure the books.json file exists and is populated
if os.path.exists('books.json'):
    with open('books.json', 'r') as file:
        books = json.load(file)

    # Create XML root element
    root = ET.Element('books')

    # Add book entries to XML
    for book in books:
        book_element = ET.SubElement(root, 'book')
        for key, value in book.items():
            child = ET.SubElement(book_element, key)
            child.text = str(value)

    # Write the XML data to a file
    tree = ET.ElementTree(root)
    tree.write('books.xml', encoding='utf-8', xml_declaration=True)
    print("Books exported to books.xml")

else:
    print("Error: books.json not found.")