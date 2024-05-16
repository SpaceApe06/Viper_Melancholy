function deleteUser(userId) {
    fetch('/api/delete_user.php', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: userId }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('User deleted successfully');
            location.reload(); // Reload the page
        } else {
            alert('Failed to delete user');
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

function addAdmin(userId) {
    window.location.href = '/add_admin.php?id=' + userId;
}