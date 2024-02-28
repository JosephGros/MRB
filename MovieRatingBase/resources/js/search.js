
document.getElementById('search').addEventListener('input', function(){
    let query = this.value;
    if (query.length >= 2) {
        fetch('/search?query=${query}')
        .then(response => response.json())
        .then(data => {
            displaySearchResults(data);
        })
        .catch(error =>  console.error('Error', error));
    } else {
        document.getElementById('search-results').innerHTML = '';
    }
}); 

function displaySearchResults(data) {
    let searchResults = document.getElementById('search-results');
    searchResults.innerHTML = '';

    data.forEach(result => {
        let li = document.createElement('li');
        li.textContent = result.name;
        li.classList.add('search-result-item');
        li.dataset.resultId = result.id;
        searchResults.appendChild(li);
    });
}