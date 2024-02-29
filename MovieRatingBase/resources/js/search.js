
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

document.getElementById('search-results').addEventListener('click', function(event) {
    let target = event.target;
    if(target && target.matches('li.search-result-item')) {
        let resultType = target.dataset.resultType;
        let resultId = target.dataset.resultId;
        
        let currentPage = '{{ $currentPage }}';

        if (currentPage === 'editMovies' || currentPage === 'editSeries') {
            if (resultType === 'actors') {
                let selectedActors = document.getElementById('selected-actors');

                let actorName = target.textContent;
                let actorId = target.dataset.resultId;

                let actorRole = document.createElement('div');
                actorRole.innerHTML = `
                <div class="font-semibold">${actorName}</div>
                <input type="text" class="block mt-1 w-full border-sky-900 shadow-sm rounded-md sm:text-sm focus:ring-sky-500 focus:border-sky-500" placeholder="Enter role..." data-actor-id="${actorId}">
                `
            }
        }
    }
})