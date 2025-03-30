document.addEventListener('DOMContentLoaded', function () {
    let addBlogCheckbox = document.getElementById('addBlog');
    let blogContent = document.getElementById('blogContent');
    let categorySelect = document.getElementById('category');
    let subcategoryContainer = document.getElementById('subcategoryContainer');
    let subcategorySelect = document.getElementById('subcategory');

    if(addBlogCheckbox.checked){
        blogContent.classList.remove('d-none');
    }
    // Toggle blog content field
    addBlogCheckbox.addEventListener('change', function () {
        blogContent.classList.toggle('d-none', !this.checked);
    });

    // Fetch subcategories based on category selection
    categorySelect.addEventListener('change', function () {
        let categoryId = this.value;
        if (categoryId) {
            fetch(`/artist/categories/${categoryId}/subcategories`)
                .then(response => response.json())
                .then(data => {
                    subcategoryContainer.classList.remove('d-none');
                    subcategorySelect.innerHTML = '<option value="">Select a Subcategory</option>';
                    data.forEach(subcategory => {
                        subcategorySelect.innerHTML += `<option value="${subcategory.id}">${subcategory.name}</option>`;
                    });
                });
        } else {
            subcategoryContainer.classList.add('d-none');
            subcategorySelect.innerHTML = '<option value="">Select a Subcategory</option>';
        }
    });
});
