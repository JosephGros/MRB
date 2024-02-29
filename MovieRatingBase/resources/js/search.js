
document.getElementById('search').addEventListener('input', function(){
    let query = this.value;
    if (query.length >= 2) {
        fetch(`/search?query=${query}`)
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();})
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
    console.log(data);
        
    for (let category in data) {
        if (data.hasOwnProperty(category)) {
            // Check if the category is an array
            if (Array.isArray(data[category])) {
                // Iterate over the items in the category array
                data[category].forEach(item => {
                    let li = document.createElement('li');
                    li.textContent = item.name;
                    li.classList.add('search-result-item');
                    li.dataset.resultId = item.id;
                    li.dataset.resultType = category; // Set the category as the result type
                    searchResults.appendChild(li);
                });
            }
        }
    }
}

// document.getElementById('search-results').addEventListener('click', function(event) {
//     let target = event.target;
//     if(target && target.matches('li.search-result-item')) {
//         let resultType = target.dataset.resultType;
//         let resultId = target.dataset.resultId;
        
//         let currentPage = '{{ $currentPage }}';

//         if (currentPage === 'editMovies' || currentPage === 'editSeries') {

//             switch (resultType){
//                 case 'actors':
//                     addActor(resultId);
//                     break;
//                 case 'genres':
//                 case 'directors':
//                 case 'creators':
//                 case 'writers':
//                     addEntity(resultType, resultId);
//                     break;
//                 default:
//                     break;
//             }

//         } else {
//             if (resultType === 'movies') {
//                 window.location.href = '/movies/' + resultId;
//             } else if (resultType === 'series') {
//                 window.location.href = '/series/' + resultId;
//             }
//         }
//     }
// });
 
// function addEntity(entityType, entityId){
//     let selectedEntities = document.getElementById('selected-' + entityType);

//     let entityName = target.textContent;
//     let entityItem = document.createElement('div');
//     entityItem.innerHTML = `
//         <div class="font-semibold">${entityName}</div>
//         <input type="hidden" name="${entityType}[]" value="${entityId}" class="'block', 'mt-1', 'w-full', 'border-sky-900', 'shadow-sm', 'rounded-md', 'sm:text-sm', 'focus:ring-sky-500', 'focus:border-sky-500'">
//     `;

//     selectedEntities.appendChild(entityItem);
// }

// function addActor(actorId){

//     let actorName = document.querySelector(`[data-result-id="${actorId}"]`).textContent;

//     let selectedActors = document.getElementById('selected-actors');

//     let actorTitle = document.createElement('div');
//     actorTitle.classList.add('border', 'border-sky-900', 'p-3', 'rounded-md', 'mb-2')

//     let actorRole = document.createElement('input');
//     actorRole.type = 'text';
//     actorRole.placeholder = 'Enter role...';
//     actorRole.classList.add('block', 'mt-1', 'w-full', 'border-sky-900', 'shadow-sm', 'rounded-md', 'sm:text-sm', 'focus:ring-sky-500', 'focus:border-sky-500');
//     actorRole.dataset.actorId = actorId;

//     actorTitle.innerHTML = `<div class="font-semibold">${actorName}</div>`;

//     actorTitle.appendChild(actorRole)

//     selectedActors.appendChild(actorTitle);

// }