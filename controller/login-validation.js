function validateForm() {
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;
  let errorMessage = '';

  // Validasi username/email
  if (!username) {
    errorMessage += 'Username/Email harus diisi.\n';
  }

  // Validasi password
  if (!password) {
    errorMessage += 'Password harus diisi.\n';
  }
  if (errorMessage) {
    alert(errorMessage);
    return false;
  }

  // Cek Username dan Password
  if (username == 'admin@gmail.com' && password == 'admin123') {
    window.location.href = 'admin.html';
    return false; // Mencegah form dari submit
  } 
  else if(username == `user@gmail.com` && password == `user123`) {
    window.location.href = 'user.html';
    return false;
  }
  else {
    alert('Username atau password salah.');
    return false;
  }
}