// Mobile Navigation Menu
const mobileMenuButton = document.getElementById('mobile-menu-button');
const mobileMenu = document.getElementById('mobile-menu');

if (mobileMenuButton) {
    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
}

// Dropdown Menu
const userMenuButton = document.getElementById('user-menu-button');
const userMenu = document.getElementById('user-menu');

if(userMenuButton) {
    userMenuButton.addEventListener('click', () => {
        userMenu.classList.toggle('hidden');
    });
    
    document.addEventListener('click', (event) => {
        if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
            userMenu.classList.add('hidden');
        }
    });
}

// Modal
const flashModal = document.getElementById('flash-alert');

if (flashModal) {
    flashModal.addEventListener('click', (e) => {
        if (e.target === flashModal) {
            flashModal.classList.add('hidden');
            flashModal.classList.remove('flex');
        }
    });
}

// Filtering Button
const categories = document.querySelectorAll('[id^="menu"]');
const posts = document.querySelectorAll('[data-category]');
const postContainer = document.getElementById('posts-container');

if(categories && postContainer) {
    categories.forEach((category) => {
        category.addEventListener('click', function(e) {
            categories.forEach((el) => {
                el.classList.remove('bg-indigo-100', 'text-indigo-600');
                el.classList.add('text-gray-100');
            });

            category.classList.remove('text-gray-100');
            category.classList.add('bg-indigo-100', 'text-indigo-600');

            const selectedCategory = category.dataset.menu;
            let queryItems = [...posts];

            if (selectedCategory != 'all') {
                queryItems = queryItems.filter((post) => post.dataset.category === selectedCategory);
            }

            postContainer.innerHTML = '';
            
            if(queryItems.length === 0) {
                const messageEl = document.createElement('div');
                messageEl.textContent = 'No posts found.';
                messageEl.classList.add('text-gray-500', 'text-center', 'py-4'); // optional styling
                postContainer.appendChild(messageEl);
            } else {
                queryItems.forEach((post) => {
                    postContainer.appendChild(post);
                });
            }
        });
    })
}


const shareButton = document.getElementById('shareToggle');
const shareMenu = document.getElementById('shareMenu');

if(shareButton) {
    shareButton.addEventListener('click', function (e) {
        e.stopPropagation();
        shareMenu.classList.toggle('hidden');
    });
    
    document.addEventListener('click', function () {
        shareMenu.classList.add('hidden');
    });
}


const editButtons = document.querySelectorAll('[data-comment-id][data-comment-body]');
const editModal = document.getElementById('editModal');
const closeEditModal = document.getElementById('cancelModalBtn');
const modalContent = document.getElementById('editModalContent');
const editCommentForm = document.getElementById('editCommentForm');
const commentBodyInput = document.getElementById('modalCommentBody');

if(editButtons) {
    editButtons.forEach((edit) => {
        edit.addEventListener('click', function (e) {
            const commentId = edit.getAttribute('data-comment-id');
            const commentBody = edit.getAttribute('data-comment-body');
            const commentUrl = edit.getAttribute('data-route-comment');

            commentBodyInput.value = commentBody;
            editCommentForm.action = commentUrl + commentId;

            editModal.classList.remove('hidden');
        })
    })

    // Close Modal
    const closeModal = () => editModal.classList.add('hidden');

    closeEditModal.addEventListener('click', closeModal);
    editModal.addEventListener('click', (event) => {
        if (!modalContent.contains(event.target)) {
            closeModal();
        }
    });
}