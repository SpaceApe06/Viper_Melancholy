function addAdmin(userId) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_admin.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('user_id=' + userId);
  }
  
  function deleteUser(userId) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'delete_user.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('user_id=' + userId);
  }