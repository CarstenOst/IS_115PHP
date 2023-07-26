function loadContent(file) {
    fetch(file)
        .then(response => response.text())
        .then(data => {
            document.getElementById('title').innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
        });
}