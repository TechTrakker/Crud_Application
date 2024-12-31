$(document).ready(function () {
    function loadPosts() {
        $.post('ajax_handler.php', { action: 'fetchPosts' }, function (posts) {
            $('#postsContainer').html(posts.map(post => `
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">${post.title}</h5>
                        <p class="card-text">${post.text}</p>
                        <button class="btn btn-danger deletePost" data-id="${post.id}">Delete</button>
                    </div>
                </div>
            `).join(''));
        }, 'json');
    }

    if ($('#postsContainer').length) loadPosts();

    $('#signupForm').submit(function (e) {
        e.preventDefault();
        $.post('ajax_handler.php', $(this).serialize() + '&action=signup', function (response) {
            alert(response.message);
            if (response.status === 'success') location.reload();
        }, 'json');
    });

    $('#loginForm').submit(function (e) {
        e.preventDefault();
        $.post('ajax_handler.php', $(this).serialize() + '&action=login', function (response) {
            alert(response.message);
            if (response.status === 'success') location.reload();
        }, 'json');
    });

    $('#logoutBtn').click(function () {
        $.post('ajax_handler.php', { action: 'logout' }, function () {
            location.reload();
        });
    });

    $('#postForm').submit(function (e) {
        e.preventDefault();
        $.post('ajax_handler.php', $(this).serialize() + '&action=createPost', function (response) {
            alert(response.message);
            if (response.status === 'success') loadPosts();
        }, 'json');
    });

    $(document).on('click', '.deletePost', function () {
        const postId = $(this).data('id');
        $.post('ajax_handler.php', { action: 'deletePost', id: postId }, function (response) {
            alert(response.message);
            if (response.status === 'success') loadPosts();
        }, 'json');
    });
});
