
document.getElementById('search').addEventListener('input', function(){
    let query = this.value;
    if (query.length >= 2) {
        fetch('/search?query=${query}')
        .then(response => response.json())
        .then(data => {
            displaySearchResults(data);
        })
    }
})