document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-query');
    const suggestionsContainer = document.getElementById('search-suggests-results');
    const suggestionsList = document.getElementById('search-suggestions-list');

    searchInput.addEventListener('input', function(e) {
        const query = e.target.value;

        if (query.length >= 2) {
            // Show the suggestions dropdown
            suggestionsContainer.style.display = 'block';

            // Make the AJAX request to fetch suggestions
            fetch(`/search-suggestions?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    // Clear previous suggestions
                    suggestionsList.innerHTML = '';

                    // If no products found, show "No products found"
                    if (data.products.length === 0) {
                        suggestionsList.innerHTML = '<li>No products found</li>';
                    } else {
                        // Populate the suggestions list with fetched products
                        data.products.forEach(product => {
                            const listItem = document.createElement('li');
                            listItem.classList.add('search-result-item');

                            // Use the productDetailRoute and append the product slug
                            listItem.innerHTML = `
                                <a href="${productDetailRoute + product.slug}" class="search-result-item">
                                    <div class="img-box">
                                        <img src="${product.photo}" alt="${product.title}">
                                    </div>
                                    <div class="box-content">
                                        <p class="title link">${product.title}</p>
                                        <div class="price">
                                            ${product.discount ?
                                                `<span class="old-price">$${product.price}</span>
                                                <span class="new-price">$${product.discount}</span>`
                                                : `$${product.price}`
                                            }
                                        </div>
                                        <p class="condition">${product.condition}</p>
                                    </div>
                                </a>
                            `;
                            suggestionsList.appendChild(listItem);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching search suggestions:', error);
                });
        } else {
            // Hide suggestions if query is too short
            suggestionsContainer.style.display = 'none';
        }
    });

    // Optionally, hide the suggestions when clicking outside the search box
    document.addEventListener('click', function(e) {
        if (!document.getElementById('search-form').contains(e.target)) {
            suggestionsContainer.style.display = 'none';
        }
    });

    // Prevent form submission on Enter
    document.getElementById('search-form').addEventListener('submit', function(e) {
        e.preventDefault();  // Prevent form from submitting
    });
});
